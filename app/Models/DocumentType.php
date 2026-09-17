<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentType extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'id',
        'name',
        'sort_order',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
