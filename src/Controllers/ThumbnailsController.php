<?php

namespace Leeto\Thumbnails\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ThumbnailsController extends BaseController
{
    public function generate(string $dir, string $method, string $size, string $file)
    {
        $allowedSizes = config('thumbnails.allowed_sizes') ?? [];

        if (!in_array($size, $allowedSizes)) {
            abort(403, 'Size is not allowed');
        }

        $originalPath = "$dir/$file";
        $dirPath = "$dir/$method/$size";
        $fullPath = "$dirPath/$file";

        $storage = Storage::disk(config('thumbnails.disk') ?? null);

        if (!$storage->exists($dirPath)) {
            $storage->makeDirectory($dirPath);
        }

        if (!$storage->exists($fullPath)) {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($storage->path($originalPath));

            $sizes = Str::of($size);

            if ($sizes->contains('x')) {
                $image->{$method}(
                    $sizes->before('x')->toString(),
                    $sizes->after('x')->toString()
                );
            } else {
                $image->{$method}($sizes->toString());
            }

            $image->save($storage->path($fullPath));
        }

        return response()->file($storage->path($fullPath));
    }
}
