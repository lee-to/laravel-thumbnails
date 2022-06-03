# Генератор миниатюр изображений для Laravel

Все манипуляции с изображениями проводятся на основе пакет https://github.com/Intervention/image

При первом обращении к файлу происходит генерации на основе заданных параметров (метод, размер)

А далее уже берется сгенерированное изображение, тем самым обращаемся к генерации единожды

## Установка

```shell
composer require lee-to/laravel-thumbnails
```

```shell
php artisan vendor:publish --provider="Leeto\Thumbnails\Providers\ThumbnailsServiceProvider"
```

## Использование 
#### Конфиг

```php
return [
    // Диск filesystem
    'disk' => env('FILESYSTEM_DISK', 'local'),

    // Допустимые значения размеров, в противном случае 403
    'allowed_sizes' => ['150x150'],

    // Значения по умолчанию для метода thumbnails
    'defaults' => [
        'field' => 'photo',
        'dir' => 'images',
        'size' => '150x150',
        'method' => 'resize',
    ]
];
```
#### Добавьте trait Leeto\Thumbnails\Traits\WithThumbnails для необходимой модели

```vue
    <img src="{{ $model->thumbnail('image', 'crop', '150x150') }}" />
```

#### Вывод изображения

```php
    $model->thumbnail($field, $method, $size);
```

```php
    $model->thumbnail();
    // Можно ничего не указывать, тогда установятся значения из конфига defaults
```

#### Описание аргументов метода thumbnail

- $field = Поле в таблице в котором хранится наименование изображения или массив изображений
- $method = Метод обработки изображения (Допустимы crop,fit и resize)
- $size = Размер итогового изображения (Пример 100x100 или 100)
- $dir = Директория где хранится изображение (По умолчанию берется из конфига)
