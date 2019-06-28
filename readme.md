# Mediavel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

A media library handler for Laravel.

Right now, it only supports upload images and generate thumbnails from them.

## Installation

Via Composer

``` bash
$ composer require e200/mediavel
```

## Usage

```php
$mediaLibrary = new MediaLibrary();

$media = $mediaLibrary
  ->add($request->image)         // Store the image
  ->preserveOriginal()           // Do not touch the original file
  ->resize('small', [75, 75])    // Creates a thumbnail (75x75) derived from the original image
  ->resize('medium', [150, 150]) // Creates a thumbnail (150x150)
  ->resize('large', [1024, 300]) // Creates a thumbnail (1024x300);

$media->id;            // 1
$media->relative_path; // /images/2018/12/sl290s8xq0is9wqjk.jpg
$media->url;           // http://localhost:8000/images/2019/06/5cf6976f20dfb.jpg

$thumbs = $media->thumbs();

$thumbs['small']->path;  // /images/2018/12/5cf6976f20dfb-75x75.jpg
$thumbs['medium']->path; // /images/2018/12/5cf6976f20dfb-150x150.jpg
$thumbs['large']->path;  // /images/2018/12/5cf6976f20dfb-1024x300.jpg
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email eleandro@inbox.ru instead of using the issue tracker.

## Credits

- [Eleandro Duzentos][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/e200/mediavel.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/e200/mediavel.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/e200/mediavel/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/e200/mediavel
[link-downloads]: https://packagist.org/packages/e200/mediavel
[link-travis]: https://travis-ci.org/e200/mediavel
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/e200
[link-contributors]: ../../contributors
