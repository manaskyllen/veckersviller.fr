<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Document>
 */
class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition(): array
    {
        return [
            'document_type_id' => DocumentType::factory(),
            'title' => fake()->sentence(8),
            'document_date' => fake()->dateTimeBetween('-10 years', 'now'),
            'file_path' => 'documents/' . fake()->uuid() . '.pdf',
        ];
    }
}
