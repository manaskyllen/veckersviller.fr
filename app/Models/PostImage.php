<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PostImage extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'post_id',
        'path',
        'alt_text',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::deleting(function (PostImage $image): void {
            if ($image->path !== null) {
                Storage::disk('public')->delete($image->path);
            }
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
