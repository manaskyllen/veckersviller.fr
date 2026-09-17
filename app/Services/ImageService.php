<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Format;

class ImageService
{
    public function storePostImage(UploadedFile $file): string
    {
        $manager = ImageManager::usingDriver(Driver::class);

        $image = $manager->decodePath($file->getRealPath());

        $image->scaleDown(2000, 2000);

        $path = 'posts/' . Str::ulid() . '.webp';

        Storage::disk('public')->put(
            $path,
            $image->encodeUsingFormat(Format::WEBP, quality: 85)
        );

        return $path;
    }
}
