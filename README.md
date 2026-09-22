# Mairie de Veckersviller

Site officiel de la **Mairie de Veckersviller**, développé avec Laravel et Filament.

L'application permet de présenter les informations de la commune aux habitants et visiteurs, tout en fournissant à l'équipe municipale une interface d'administration permettant de gérer le contenu du site.

## Fonctionnalités

### Site public

* Page d'accueil avec les principales informations municipales
* Présentation des coordonnées de la mairie
* Affichage des horaires d'ouverture
* Affichage des actualités communales
* Consultation détaillée des actualités
* Galerie d'images associée aux actualités
* Consultation des documents municipaux
* Classement des documents par catégorie et par date
* Système d'alerte temporaire affiché sur le site
* Formulaire de contact
* Pages légales :

  * Mentions légales
  * Données personnelles
  * Accessibilité

### Administration

L'administration est réalisée avec **Filament** et permet notamment de gérer :

* les paramètres généraux du site ;
* les coordonnées de la mairie ;
* les horaires d'ouverture ;
* les actualités ;
* les images associées aux actualités ;
* les documents municipaux ;
* les catégories de documents ;
* les alertes du site ;
* les messages envoyés depuis le formulaire de contact.

L'accès à l'administration est protégé par authentification et prend en charge l'authentification multifacteur avec codes de récupération.

## Architecture

L'application repose sur une architecture Laravel classique :

```text
veckersviller.fr/
├── app/
│   ├── Filament/
│   │   ├── Pages/
│   │   ├── Resources/
│   │   └── Widgets/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Requests/
│   ├── Mail/
│   ├── Models/
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── docker/
│   ├── nginx/
│   └── php/
├── lang/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
├── storage/
├── tests/
├── docker-compose.yml
├── composer.json
├── package.json
└── vite.config.js
```

## Stack technique

### Backend

* **PHP 8.4**
* **Laravel 13**
* **Filament 5**
* **PostgreSQL 17**
* **Intervention Image 4**

### Frontend

* **Blade**
* **Tailwind CSS 4**
* **Alpine.js**
* **Vite**

### Infrastructure

* **Docker**
* **Nginx**
* **PHP-FPM**
* **PostgreSQL**

Le conteneur PHP embarque également Node.js et npm afin de permettre l'installation des dépendances frontend et la compilation des assets sans nécessiter Node.js installé directement sur la machine hôte.

## Prérequis

Le seul prérequis nécessaire pour le développement local est :

* Docker
* Docker Compose

PHP, Composer, Node.js, npm, PostgreSQL et Nginx sont fournis ou exécutés via Docker.

## Installation

Cloner le dépôt :

```bash
git clone <repository-url>
cd veckersviller.fr
```

Créer le fichier d'environnement :

```bash
cp .env.example .env
```

Démarrer les conteneurs :

```bash
docker compose up -d --build
```

Installer les dépendances PHP :

```bash
docker compose exec app composer install
```

Générer la clé d'application :

```bash
docker compose exec app php artisan key:generate
```

Exécuter les migrations :

```bash
docker compose exec app php artisan migrate
```

Installer les dépendances JavaScript :

```bash
docker compose exec app npm install
```

Compiler les assets :

```bash
docker compose exec app npm run build
```

Créer le lien symbolique du stockage public :

```bash
docker compose exec app php artisan storage:link
```

L'application est ensuite accessible localement à l'adresse :

```text
http://localhost:8080
```

## Configuration de la base de données

L'environnement Docker fournit automatiquement un conteneur PostgreSQL.

Configuration utilisée par défaut :

```env
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=veckersviller
DB_USERNAME=veckersviller
DB_PASSWORD=secret
```

Pour un environnement de production, les identifiants doivent naturellement être remplacés par des valeurs sécurisées.

## Développement

Pour lancer le serveur frontend Vite en mode développement :

```bash
docker compose exec app npm run dev
```

Les services Docker peuvent être démarrés avec :

```bash
docker compose up -d
```

Pour afficher les logs :

```bash
docker compose logs -f
```

Pour afficher uniquement les logs de l'application :

```bash
docker compose logs -f app
```

Pour arrêter l'environnement :

```bash
docker compose down
```

Pour supprimer également les données PostgreSQL :

```bash
docker compose down -v
```

> Cette dernière commande supprime le volume PostgreSQL. Autrement dit, elle fait exactement ce qu'on lui demande, parce que les bases de données ont malheureusement décidé qu'elles aimaient disparaître quand on utilise les mauvais boutons.

## Gestion des actualités

Les actualités sont stockées en base de données et disposent notamment de :

* titre ;
* slug ;
* description ;
* date de publication ;
* images ;
* ordre des images.

Les slugs sont générés automatiquement à partir du titre lorsqu'ils ne sont pas renseignés.

Les actualités sont accessibles publiquement depuis :

```text
/actualites
```

Chaque actualité possède sa propre URL basée sur son slug.

## Gestion des documents

Les documents municipaux sont associés à un type de document et possèdent notamment :

* un titre ;
* une date ;
* un fichier ;
* une catégorie.

Les documents peuvent être utilisés pour publier différentes ressources municipales, par exemple :

* listes et délibérations ;
* procès-verbaux ;
* arrêtés ;
* documents divers ;
* documents liés à l'état civil.

Les documents sont accessibles publiquement depuis :

```text
/documents
```

## Horaires de la mairie

Les horaires sont stockés en base de données afin de pouvoir être modifiés depuis l'administration.

Chaque jour peut être :

* ouvert ou fermé ;
* associé à une plage horaire le matin ;
* associé à une plage horaire l'après-midi.

Cela permet d'afficher les horaires de manière cohérente sur les différentes pages du site.

## Alertes

Le site dispose d'un système d'alertes permettant d'afficher temporairement une information importante.

Une alerte possède :

* un titre ;
* un contenu ;
* une date de début ;
* une date de fin.

Le système permet ainsi de publier des informations ponctuelles sans modifier directement les pages du site.

## Formulaire de contact

Le formulaire de contact permet aux visiteurs d'envoyer un message à la mairie.

Les informations enregistrées comprennent notamment :

* prénom ;
* nom ;
* adresse e-mail ;
* numéro de téléphone ;
* objet ;
* message ;
* statut du message ;
* date de lecture ;
* date d'acceptation de la politique de confidentialité.

Les messages peuvent ensuite être consultés depuis l'administration.

## Images

Les images envoyées dans l'application sont traitées avec **Intervention Image**.

Le traitement permet notamment de convertir les images dans un format WebP optimisé afin de réduire leur poids tout en conservant une qualité adaptée à une utilisation web.

Les fichiers sont stockés via le système de stockage de Laravel.

Après installation, le lien symbolique vers le stockage public peut être créé avec :

```bash
docker compose exec app php artisan storage:link
```

## Authentification et sécurité

L'interface d'administration Filament est accessible depuis :

```text
/admin
```

Elle utilise :

* authentification Laravel / Filament ;
* gestion des sessions ;
* protection CSRF ;
* authentification multifacteur ;
* codes de récupération MFA.

L'authentification multifacteur est configurée directement dans le panneau d'administration Filament.

Les fichiers sensibles et fichiers de configuration ne doivent pas être versionnés.

Le fichier `.env` ne doit notamment jamais être commité.

## Tests

Le projet utilise PHPUnit et le système de tests Laravel.

Lancer les tests :

```bash
docker compose exec app php artisan test
```

Ou :

```bash
docker compose exec app composer test
```

## Code style

Laravel Pint est utilisé pour le formatage du code PHP.

Lancer Pint :

```bash
docker compose exec app ./vendor/bin/pint
```

## Commandes Artisan utiles

Afficher la liste des commandes disponibles :

```bash
docker compose exec app php artisan list
```

Vider les caches Laravel :

```bash
docker compose exec app php artisan optimize:clear
```

Exécuter les migrations :

```bash
docker compose exec app php artisan migrate
```

Créer un lien vers le stockage public :

```bash
docker compose exec app php artisan storage:link
```

Accéder à Tinker :

```bash
docker compose exec app php artisan tinker
```

## Déploiement

L'application peut être déployée sur un serveur disposant de Docker et Docker Compose.

Une configuration de production doit notamment prévoir :

* une valeur `APP_KEY` propre à l'environnement ;
* `APP_ENV=production` ;
* `APP_DEBUG=false` ;
* des identifiants PostgreSQL sécurisés ;
* une configuration SMTP fonctionnelle ;
* un stockage persistant pour les fichiers ;
* un certificat TLS ;
* une sauvegarde régulière de la base PostgreSQL ;
* une sauvegarde des fichiers uploadés.

Après déploiement, les assets frontend doivent être compilés :

```bash
docker compose exec app npm run build
```

Puis les caches Laravel peuvent être optimisés :

```bash
docker compose exec app php artisan optimize
```

## Variables d'environnement

Les principales variables Laravel sont définies dans `.env`.

Exemple minimal :

```env
APP_NAME="Mairie de Veckersviller"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=veckersviller
DB_USERNAME=veckersviller
DB_PASSWORD=secret
```

La configuration mail doit être renseignée selon le fournisseur SMTP utilisé par l'environnement.

## Licence

Aucune licence spécifique au projet n'est actuellement définie dans le dépôt.

Le projet utilise toutefois des dépendances open source distribuées sous leurs propres licences. Les conditions de chaque dépendance doivent être respectées lors de leur utilisation.

## Auteur

Projet développé par **Alexis Henry** pour la **Mairie de Veckersviller**.

Le site est destiné à fournir aux habitants et aux visiteurs un accès simple aux informations et documents municipaux, tout en permettant à la mairie de gérer son contenu depuis une interface d'administration centralisée.