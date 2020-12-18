<?php

namespace Leeto\Thumbnails\Traits;

use Illuminate\Support\Facades\File;

trait Thumbnail
{
    public function getThumbnail($field = null, $method = null, $size = null, $dir = null) {
        $field = is_null($field) ? config("thumbnails.defaults.field") : $field;
        $method = is_null($method) ? config("thumbnails.defaults.method") : $method;
        $size = is_null($size) ? config("thumbnails.defaults.size") : $size;
        $dir = is_null($dir) ? config("thumbnails.defaults.dir") : $dir;

        $file = is_array($this->{$field}) ? collect($this->{$field})->first() : $this->{$field};

        if(!$file) {
            return "https://via.placeholder.com/{$size}";
        }

        return route("thumbnail", ["dir" => $dir, "method" => $method, "size" => $size, "file" => File::basename($file)]);
    }
}