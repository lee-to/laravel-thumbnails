# laravel-thumbnails

## Install
- composer require lee-to/laravel-thumbnails

- php artisan vendor:publish --provider="Leeto\Thumbnails\Providers\ThumbnailsServiceProvider"

## Usage 
- add trait to model "use Leeto\Thumbnails\Traits\Thumbnail"
- use getThumbnail($field = null, $method = null, $size = null, $dir = null)
field = model thumbnail|thumbnails field
method = crop,fit,resize
size = 100x100|100
dir = storage dir (images)
