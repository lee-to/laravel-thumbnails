<?php

return [
    'disk' => env('FILESYSTEM_DRIVER', 'local'),

    'allowed_sizes' => ['150x150'],

    'defaults' => [
        'field' => 'photo',
        'dir' => 'images',
        'size' => '150x150',
        'method' => 'resize',
    ]
];
