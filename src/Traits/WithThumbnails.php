<?php

namespace Leeto\Thumbnails\Traits;

use Illuminate\Support\Facades\File;

trait WithThumbnails
{
    public function thumbnail($field = null, $method = null, $size = null, $dir = null) {
        $field = $field ?? config('thumbnails.defaults.field');

        $file = is_array($this->{$field}) ? collect($this->{$field})->first() : $this->{$field};

        if(!$file) {
            return "https://via.placeholder.com/$size";
        } else {
            $file = File::basename($file);
        }

        return route('thumbnails.generate', [
            'dir' => $dir ?? config('thumbnails.defaults.dir'),
            'method' => $method ?? config('thumbnails.defaults.method'),
            'size' => $size ?? config('thumbnails.defaults.size'),
            'file' => $file
        ]);
    }
}