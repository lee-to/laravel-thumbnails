<?php

use Illuminate\Support\Facades\Route;

use Leeto\Thumbnails\Controllers\ThumbnailsController;

Route::get('/storage/{dir}/{method}/{size}/{file}', [ThumbnailsController::class, 'generate'])
    ->where('dir', '[^/]+(/[^/]+)*')
    ->where('method', 'cover|coverDown|crop|resize|resizeDown|scale|scaleDown')
    ->where('size', '\d+x\d+|\d+')
    ->where('file', '.+\.(png|jpg|gif|bmp|jpeg|PNG|JPG|GIF|BMP|JPEG)$')
    ->name('thumbnails.generate');
