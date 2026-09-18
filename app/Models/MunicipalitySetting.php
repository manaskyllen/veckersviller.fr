<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MunicipalitySetting extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'address',
        'postal_code',
        'city',
        'contact_email',
    ];
}
