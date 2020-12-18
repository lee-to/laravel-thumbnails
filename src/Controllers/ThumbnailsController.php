<?php

namespace Leeto\Thumbnails\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ThumbnailsController extends BaseController
{
    public function get($dir, $method, $size, $file) {

        $original = storage_path(config("thumbnails.storage_path") . "/{$dir}/{$file}");
        $resultDir = storage_path(config("thumbnails.storage_path") . "/{$dir}/{$method}/$size");
        $result = storage_path(config("thumbnails.storage_path") . "/{$dir}/{$method}/{$size}/{$file}");

        if(!File::exists($result)) {
            if(!File::exists($resultDir)) {
                File::makeDirectory($resultDir, 755, true);
            }

            $image = Image::make($original);

            if(Str::contains($size, "x")) {
                $image->{$method}(Str::before($size, "x"), Str::after($size, "x"));
            } else {
                $image->{$method}($size, $size);
            }

            $image->save($result);
        }

        return response()->file($result);

    }
}
