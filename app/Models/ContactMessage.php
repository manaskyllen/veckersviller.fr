<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasUuids;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'read_at',
        'privacy_accepted_at',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'privacy_accepted_at' => 'datetime',
        ];
    }
}
