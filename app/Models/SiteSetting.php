<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SiteSetting extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'site_name',
        'site_tagline',
        'logo_header',
        'logo_footer',
        'hero_image',
    ];
}
