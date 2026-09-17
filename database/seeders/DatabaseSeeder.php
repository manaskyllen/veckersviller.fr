<?php

namespace Database\Seeders;

use App\Models\Alert;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory(15)->create();

        Alert::factory()->create([
            'title' => 'Information importante',
            'content' => 'Ceci est une alerte de démonstration.',
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addWeek(),
        ]);

        $documentTypes = collect([
            'Arrêté',
            'Délibération',
            'Procès-verbal',
            'Divers',
            'État civil',
        ])->mapWithKeys(function (string $name, int $index) {
            $type = DocumentType::create([
                'name' => $name,
                'sort_order' => $index,
            ]);

            return [$name => $type];
        });

        foreach ($documentTypes as $type) {
            Document::factory(8)->create([
                'document_type_id' => $type->id,
            ]);
        }
    }
}
