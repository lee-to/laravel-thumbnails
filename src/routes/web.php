<?php
use Illuminate\Support\Facades\Route;

Route::get('/storage/{dir}/{method}/{size}/{file}', [\Leeto\Thumbnails\Controllers\ThumbnailsController::class, 'get'])
        ->where('method', 'resize|crop|fit')
        ->where('size', '\d+x\d+|\d+')
        ->where('file', '.+\.png|jpg|gif|bmp|jpeg|PNG|JPG|GIF|BMP|JPEG$')
->name("thumbnail");