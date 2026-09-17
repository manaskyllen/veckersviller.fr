from __future__ import annotations

import json
import re
import unicodedata
import uuid
from datetime import datetime
from pathlib import Path
from urllib.parse import urljoin

import httpx
from bs4 import BeautifulSoup


# ---------------------------------------------------------------------------
# Configuration
# ---------------------------------------------------------------------------

BASE_URL = "https://www.lixheim.net"

ACTUALITES_URL = (
    f"{BASE_URL}/copie-de-actualit%C3%A9-associations"
)

OUTPUT_DIR = Path("output")

POSTS_JSON = OUTPUT_DIR / "posts.json"
POST_IMAGES_JSON = OUTPUT_DIR / "post_images.json"
DOCUMENT_TYPES_JSON = OUTPUT_DIR / "document_types.json"
DOCUMENTS_JSON = OUTPUT_DIR / "documents.json"

STORAGE_DIR = OUTPUT_DIR / "storage"

CURRENT_YEAR = datetime.now().year

HTTP_HEADERS = {
    "User-Agent": (
        "Mozilla/5.0 "
        "AppleWebKit/537.36 "
        "(KHTML, like Gecko) "
        "Chrome/131.0 Safari/537.36"
    )
}


# ---------------------------------------------------------------------------
# Documents
# ---------------------------------------------------------------------------

DOCUMENT_SOURCES = [
    {
        "name": "Arrêtés",
        "sort_order": 0,
        "url": f"{BASE_URL}/copie-de-ar-2022-3",
    },
    {
        "name": "Procès-verbaux",
        "sort_order": 1,
        "url": f"{BASE_URL}/copie-de-arr%C3%AAt%C3%A9s-2",
    },
    {
        "name": "Divers",
        "sort_order": 2,
        "url": f"{BASE_URL}/copie-de-arr%C3%AAt%C3%A9s-1",
    },
    {
        "name": "État civil",
        "sort_order": 3,
        "url": f"{BASE_URL}/copie-de-listes-et-d%C3%A9lib%C3%A9rations",
    },
    {
        "name": "Listes et délibérations",
        "sort_order": 4,
        "url": f"{BASE_URL}/copie-de-arr%C3%AAt%C3%A9s",
    },
]


# ---------------------------------------------------------------------------
# HTTP
# ---------------------------------------------------------------------------

client = httpx.Client(
    headers=HTTP_HEADERS,
    follow_redirects=True,
    timeout=30,
)


def fetch(url: str) -> str:
    response = client.get(url)
    response.raise_for_status()
    return response.text


def download_file(url: str, destination: Path) -> None:
    destination.parent.mkdir(parents=True, exist_ok=True)

    response = client.get(url)
    response.raise_for_status()

    destination.write_bytes(response.content)


# ---------------------------------------------------------------------------
# Helpers
# ---------------------------------------------------------------------------

def deterministic_uuid(value: str) -> str:
    """
    Génère toujours le même UUID pour une même valeur.
    """
    namespace = uuid.UUID(
        "4f6d6c7e-6a7e-4e3c-9e3a-1b9b1c3d5f77"
    )

    return str(uuid.uuid5(namespace, value))


def normalize_text(value: str) -> str:
    value = unicodedata.normalize("NFKC", value)
    value = re.sub(r"\s+", " ", value)
    return value.strip()


def slugify(value: str) -> str:
    value = unicodedata.normalize("NFKD", value)
    value = value.encode("ascii", "ignore").decode("ascii")
    value = value.lower()
    value = re.sub(r"[^a-z0-9]+", "-", value)
    value = value.strip("-")

    return value


def parse_french_date(value: str) -> str | None:
    """
    Convertit par exemple :
        '3 sept.' -> '2026-09-03'
        '17 août' -> '2026-08-17'

    Wix ne fournit ici que le jour et le mois.
    """

    value = normalize_text(value).lower()

    months = {
        "jan": 1,
        "janv": 1,
        "janvier": 1,
        "fev": 2,
        "fevr": 2,
        "fevrier": 2,
        "févr": 2,
        "février": 2,
        "mars": 3,
        "avr": 4,
        "avril": 4,
        "mai": 5,
        "juin": 6,
        "juil": 7,
        "juillet": 7,
        "aout": 8,
        "août": 8,
        "sept": 9,
        "septembre": 9,
        "oct": 10,
        "octobre": 10,
        "nov": 11,
        "novembre": 11,
        "dec": 12,
        "déc": 12,
        "decembre": 12,
        "décembre": 12,
    }

    match = re.search(
        r"(\d{1,2})\s+([a-zéûôàèùîï]+)",
        value,
        re.IGNORECASE,
    )

    if not match:
        return None

    day = int(match.group(1))
    month_name = match.group(2).rstrip(".")

    month = months.get(month_name)

    if month is None:
        return None

    try:
        return datetime(
            CURRENT_YEAR,
            month,
            day,
        ).strftime("%Y-%m-%d")
    except ValueError:
        return None


def extract_date_from_text(value: str) -> str | None:
    """
    Cherche une date complète dans un texte.
    Exemples :
        03/09/2026
        03-09-2026
        03.09.2026
        3 septembre 2026
    """

    value = normalize_text(value)

    numeric = re.search(
        r"\b(\d{1,2})[./-](\d{1,2})[./-](\d{4})\b",
        value,
    )

    if numeric:
        day = int(numeric.group(1))
        month = int(numeric.group(2))
        year = int(numeric.group(3))

        try:
            return datetime(year, month, day).strftime("%Y-%m-%d")
        except ValueError:
            return None

    months = {
        "janvier": 1,
        "février": 2,
        "fevrier": 2,
        "mars": 3,
        "avril": 4,
        "mai": 5,
        "juin": 6,
        "juillet": 7,
        "août": 8,
        "aout": 8,
        "septembre": 9,
        "octobre": 10,
        "novembre": 11,
        "décembre": 12,
        "decembre": 12,
    }

    pattern = (
        r"\b(\d{1,2})\s+("
        + "|".join(months.keys())
        + r")\s+(\d{4})\b"
    )

    textual = re.search(
        pattern,
        value,
        re.IGNORECASE,
    )

    if textual:
        day = int(textual.group(1))
        month = months[textual.group(2).lower()]
        year = int(textual.group(3))

        try:
            return datetime(year, month, day).strftime("%Y-%m-%d")
        except ValueError:
            return None

    return None


def get_original_wix_image_url(url: str) -> str:
    """
    Wix fournit souvent une URL transformée :

    .../image.jpg/v1/fill/w_372,h_279/.../image.webp

    On remonte à l'URL du fichier original.
    """

    marker = "/v1/"

    if marker in url:
        return url.split(marker, 1)[0]

    return url


def get_image_extension(url: str) -> str:
    """
    Détermine l'extension du fichier source Wix.
    """

    clean_url = url.split("?", 1)[0].lower()

    if clean_url.endswith(".jpeg"):
        return ".jpeg"

    if clean_url.endswith(".jpg"):
        return ".jpg"

    if clean_url.endswith(".png"):
        return ".png"

    if clean_url.endswith(".webp"):
        return ".webp"

    return ".jpg"


# ---------------------------------------------------------------------------
# Actualités
# ---------------------------------------------------------------------------

def scrape_posts() -> tuple[list[dict], list[dict]]:
    html = fetch(ACTUALITES_URL)
    soup = BeautifulSoup(html, "html.parser")

    posts: list[dict] = []
    post_images: list[dict] = []

    # -----------------------------------------------------------------------
    # Wix place les images dans une galerie séparée des post-list-item.
    #
    # Heureusement, l'attribut alt de chaque image correspond exactement
    # au titre de l'actualité.
    # -----------------------------------------------------------------------

    gallery_images: dict[str, dict] = {}

    for img in soup.select(
        'img[data-hook="gallery-item-image-img"]'
    ):
        alt = normalize_text(img.get("alt") or "")
        src = img.get("src")

        if not alt or not src:
            continue

        try:
            sort_order = int(img.get("data-idx") or 0)
        except ValueError:
            sort_order = 0

        gallery_images[alt] = {
            "src": src,
            "sort_order": sort_order,
        }

    # -----------------------------------------------------------------------
    # Articles
    # -----------------------------------------------------------------------

    containers = soup.select(
        '[data-hook="post-list-item"]'
    )

    for container in containers:
        title_element = container.select_one(
            '[data-hook="post-title"] h2'
        )

        if title_element is None:
            title_element = container.select_one(
                '[data-hook="post-title"]'
            )

        if title_element is None:
            continue

        title = normalize_text(
            title_element.get_text(" ", strip=True)
        )

        if not title:
            continue

        link_element = container.select_one(
            'a[href*="/post/"]'
        )

        if link_element is None:
            continue

        source_url = urljoin(
            BASE_URL,
            link_element.get("href", ""),
        )

        slug = source_url.rstrip("/").split("/")[-1]

        if not slug:
            slug = slugify(title)

        description_element = container.select_one(
            '[data-hook="post-description"]'
        )

        description = ""

        if description_element:
            description = normalize_text(
                description_element.get_text(
                    " ",
                    strip=True,
                )
            )

        date_element = container.select_one(
            '[data-hook="time-ago"]'
        )

        published_at = None

        if date_element:
            date_text = (
                date_element.get("title")
                or date_element.get_text(
                    " ",
                    strip=True,
                )
            )

            published_at = parse_french_date(
                date_text
            )

        post_id = deterministic_uuid(
            f"post:{slug}"
        )

        posts.append({
            "id": post_id,
            "title": title,
            "slug": slug,
            "description": description,
            "published_at": published_at,
        })

        # -------------------------------------------------------------------
        # Image associée
        # -------------------------------------------------------------------

        image = gallery_images.get(title)

        if image is None:
            print(
                f"ATTENTION : aucune image trouvée pour : {title}"
            )
            continue

        original_url = get_original_wix_image_url(
            image["src"]
        )

        extension = get_image_extension(
            original_url
        )

        image_id = deterministic_uuid(
            f"post-image:{post_id}:{image['sort_order']}"
        )

        relative_path = (
            f"posts/lixheim/{image_id}{extension}"
        )

        destination = (
            STORAGE_DIR / relative_path
        )

        try:
            download_file(
                original_url,
                destination,
            )
        except httpx.HTTPError as exception:
            print(
                f"ATTENTION : impossible de télécharger "
                f"l'image de '{title}': {exception}"
            )
            continue

        post_images.append({
            "id": image_id,
            "post_id": post_id,
            "path": relative_path,
            "alt_text": title,
            "sort_order": image["sort_order"],
        })

    return posts, post_images


# ---------------------------------------------------------------------------
# Documents
# ---------------------------------------------------------------------------

def scrape_document_types() -> list[dict]:
    document_types = []

    for source in DOCUMENT_SOURCES:
        document_type_id = deterministic_uuid(
            f"document-type:{source['name']}"
        )

        document_types.append({
            "id": document_type_id,
            "name": source["name"],
            "sort_order": source["sort_order"],
        })

    return document_types


def scrape_documents(
    document_types: list[dict],
) -> list[dict]:
    documents: list[dict] = []

    document_type_by_name = {
        document_type["name"]: document_type
        for document_type in document_types
    }

    for source in DOCUMENT_SOURCES:
        print(
            f"Scraping documents : {source['name']}"
        )

        html = fetch(source["url"])
        soup = BeautifulSoup(
            html,
            "html.parser",
        )

        document_type = document_type_by_name[
            source["name"]
        ]

        links = soup.select(
            'a[href*=".pdf"]'
        )

        seen_urls: set[str] = set()

        for link in links:
            href = link.get("href")

            if not href:
                continue

            pdf_url = urljoin(
                source["url"],
                href,
            )

            if pdf_url in seen_urls:
                continue

            seen_urls.add(pdf_url)

            title = normalize_text(
                link.get("title")
                or link.get_text(
                    " ",
                    strip=True,
                )
                or ""
            )

            if not title:
                title = Path(
                    pdf_url.split("?", 1)[0]
                ).stem

            # ---------------------------------------------------------------
            # Date uniquement si une date complète existe réellement.
            # On n'invente pas une date.
            # ---------------------------------------------------------------

            surrounding_text = normalize_text(
                link.parent.get_text(
                    " ",
                    strip=True,
                )
                if link.parent
                else ""
            )

            document_date = (
                extract_date_from_text(
                    surrounding_text
                )
                or extract_date_from_text(title)
            )

            document_id = deterministic_uuid(
                f"document:{source['name']}:{pdf_url}"
            )

            relative_path = (
                f"documents/lixheim/{document_id}.pdf"
            )

            destination = (
                STORAGE_DIR / relative_path
            )

            try:
                download_file(
                    pdf_url,
                    destination,
                )
            except httpx.HTTPError as exception:
                print(
                    f"ATTENTION : impossible de télécharger "
                    f"'{title}': {exception}"
                )
                continue

            documents.append({
                "id": document_id,
                "document_type_id": document_type["id"],
                "title": title,
                "document_date": document_date,
                "file_path": relative_path,
            })

    return documents


# ---------------------------------------------------------------------------
# JSON
# ---------------------------------------------------------------------------

def write_json(
    path: Path,
    data: list[dict],
) -> None:
    path.parent.mkdir(
        parents=True,
        exist_ok=True,
    )

    path.write_text(
        json.dumps(
            data,
            ensure_ascii=False,
            indent=2,
        ),
        encoding="utf-8",
    )


# ---------------------------------------------------------------------------
# Main
# ---------------------------------------------------------------------------

def main() -> None:
    OUTPUT_DIR.mkdir(
        parents=True,
        exist_ok=True,
    )

    print("Scraping des actualités...")

    posts, post_images = scrape_posts()

    print("Scraping des types de documents...")

    document_types = scrape_document_types()

    print("Scraping des documents...")

    documents = scrape_documents(
        document_types
    )

    write_json(
        POSTS_JSON,
        posts,
    )

    write_json(
        POST_IMAGES_JSON,
        post_images,
    )

    write_json(
        DOCUMENT_TYPES_JSON,
        document_types,
    )

    write_json(
        DOCUMENTS_JSON,
        documents,
    )

    print()
    print("TERMINÉ")
    print(
        f"Actualités       : {len(posts)}"
    )
    print(
        f"Images           : {len(post_images)}"
    )
    print(
        f"Types documents  : {len(document_types)}"
    )
    print(
        f"Documents        : {len(documents)}"
    )


if __name__ == "__main__":
    main()