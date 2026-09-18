<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OpeningHour extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'day_of_week',
        'is_open',
        'morning_open',
        'morning_close',
        'afternoon_open',
        'afternoon_close',
    ];

    protected $casts = [
        'is_open' => 'boolean',
    ];

    public function getDayNameAttribute(): string
    {
        return match ($this->day_of_week) {
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'Samedi',
            7 => 'Dimanche',
            default => 'Inconnu',
        };
    }
}
