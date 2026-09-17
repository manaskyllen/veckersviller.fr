<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class ImportLixheim extends Command
{
    protected $signature = 'lixheim:import';

    protected $description = 'Importe les données de test provenant du site de Lixheim';

    public function handle(): int
    {
        $basePath = base_path('/scripts/lixheim/output');

        if (! is_dir($basePath)) {
            $this->error("Dossier introuvable : {$basePath}");

            return self::FAILURE;
        }

        $this->info('Import Lixheim...');

        DB::transaction(function () use ($basePath): void {
            $this->importDocumentTypes($basePath);
            $this->importPosts($basePath);
            $this->importDocuments($basePath);
        });

        $this->newLine();
        $this->info('Import terminé.');

        return self::SUCCESS;
    }

    private function importDocumentTypes(string $basePath): void
    {
        $data = $this->readJson(
            $basePath . '/document_types.json'
        );

        $this->info(
            'Types de documents : ' . count($data)
        );

        foreach ($data as $item) {
            DocumentType::updateOrCreate(
                ['id' => $item['id']],
                [
                    'name' => $item['name'],
                    'sort_order' => $item['sort_order'],
                ],
            );
        }
    }

    private function importPosts(string $basePath): void
    {
        $posts = $this->readJson(
            $basePath . '/posts.json'
        );

        $images = $this->readJson(
            $basePath . '/post_images.json'
        );

        $this->info(
            'Actualités : ' . count($posts)
        );

        foreach ($posts as $item) {
            Post::updateOrCreate(
                ['id' => $item['id']],
                [
                    'title' => $item['title'],
                    'slug' => $item['slug'],
                    'description' => $item['description'],
                    'published_at' => $item['published_at'],
                ],
            );
        }

        $this->info(
            'Images : ' . count($images)
        );

        foreach ($images as $item) {
            $post = Post::find($item['post_id']);

            if ($post === null) {
                throw new RuntimeException(
                    "Post introuvable pour l'image {$item['id']} : {$item['post_id']}"
                );
            }

            $this->copyStorageFile(
                $basePath,
                $item['path'],
            );

            PostImage::updateOrCreate(
                ['id' => $item['id']],
                [
                    'post_id' => $post->id,
                    'path' => $item['path'],
                    'alt_text' => $item['alt_text'],
                    'sort_order' => $item['sort_order'],
                ],
            );
        }
    }

    private function importDocuments(string $basePath): void
    {
        $documents = $this->readJson(
            $basePath . '/documents.json'
        );

        $this->info(
            'Documents : ' . count($documents)
        );

        foreach ($documents as $item) {
            $this->copyStorageFile(
                $basePath,
                $item['file_path'],
            );

            Document::updateOrCreate(
                ['id' => $item['id']],
                [
                    'document_type_id' => $item['document_type_id'],
                    'title' => $item['title'],
                    'document_date' => $item['document_date'],
                    'file_path' => $item['file_path'],
                ],
            );
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function readJson(string $path): array
    {
        if (! is_file($path)) {
            throw new RuntimeException(
                "Fichier JSON introuvable : {$path}"
            );
        }

        $content = file_get_contents($path);

        if ($content === false) {
            throw new RuntimeException(
                "Impossible de lire : {$path}"
            );
        }

        $data = json_decode(
            $content,
            true,
            512,
            JSON_THROW_ON_ERROR,
        );

        if (! is_array($data)) {
            throw new RuntimeException(
                "Format JSON invalide : {$path}"
            );
        }

        return $data;
    }

    private function copyStorageFile(
        string $basePath,
        string $relativePath,
    ): void {
        $source = $basePath . '/storage/' . $relativePath;

        if (! is_file($source)) {
            throw new RuntimeException(
                "Fichier source introuvable : {$source}"
            );
        }

        $disk = Storage::disk('public');

        if ($disk->exists($relativePath)) {
            return;
        }

        $content = file_get_contents($source);

        if ($content === false) {
            throw new RuntimeException(
                "Impossible de lire : {$source}"
            );
        }

        $disk->put(
            $relativePath,
            $content,
        );
    }
}
