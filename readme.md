# Mediavel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require e200/mediavel
```

## Usage

```php
$mediaLibrary = new MediaLibrary();

$media = $mediaLibrary
  ->add($request->image) // Store the image
  ->backupOriginal() // Make a copy of the original image
  ->optimize() // Optimize the image (not the backup image)
  ->resize(150, 150) // Creates a thumbnail (150x150) derived from the optimized image
  ->resize(300, 300) // Creates a thumbnail (300x300)
  ->resize(1024) // Creates a thumbnail (1024xAUTO)
  ->resize('small')  // Creates a thumbnail from `mediavel.sizes.small` config
  ->resize('medium')  // Creates a thumbnail from `mediavel.sizes.medium` config
  ->resize('large')  // Creates a thumbnail from `mediavel.sizes.large` config
  ->get() // Get the File model
  ->withThumbnails(); // With the thumbnails

$media->getId(); // 1
$media->getPath(); // /images/2018/12/sl290s8xq0is9wqjk.jpg
$thumbnails = $media->getThumbnails();

$thumbnails['150x150']->getPath(); // /images/2018/12/sl290s8xq0is9wqjk-150x150.jpg
$thumbnails['medium']->getPath(); // /images/2018/12/sl290s8xq0is9wqjk-150x150.jpg
$thumbnails['large']->getPath(); // /images/2018/12/sl290s8xq0is9wqjk-1024.jpg
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

No license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/e200/mediavel.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/e200/mediavel.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/e200/mediavel/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/e200/mediavel
[link-downloads]: https://packagist.org/packages/e200/mediavel
[link-travis]: https://travis-ci.org/e200/mediavel
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/e200
[link-contributors]: ../../contributors]
