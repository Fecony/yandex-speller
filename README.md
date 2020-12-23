# Laravel Yandex Speller API Wrapper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fecony/yandex-speller.svg?style=flat-square)](https://packagist.org/packages/fecony/yandex-speller)
[![Total Downloads](https://img.shields.io/packagist/dt/fecony/yandex-speller.svg?style=flat-square)](https://packagist.org/packages/fecony/yandex-speller)
[![Build Status](https://img.shields.io/travis/Fecony/yandex-speller/main?style=flat-square)](https://travis-ci.org/Fecony/yandex-speller)
![Codecov](https://img.shields.io/codecov/c/github/Fecony/yandex-speller?style=flat-square)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Fecony/yandex-speller/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Fecony/yandex-speller/?branch=main)
[![Style CI](https://github.styleci.io/repos/322412144/shield)](https://github.styleci.io/repos/322412144/shield)

Simple Laravel Yandex Speller API response wrapper.

> Unfortunately Yandex Speller is not supported officially now 🙁
>
> Basic spellchecking is working, but options have no effect on API work...

---

## Installation

You can install the package via composer:

```bash
composer require fecony/yandex-speller
```

You can publish the package config file

```bash
php artisan vendor:publish --tag=yandex-speller
```

## Basic Usage

There are to ways of utilizing the package: using the facade, or using the helper function. On either way you will get the same result, it is totally up to you.

#### Facade:

```php
use Fecony\YandexSpeller\Facade\YandexSpeller;

...

public function index()
{
    $result = YandexSpeller::check('Helllo world!');
    // Do whatever you want with results
    // $this->someService->swapWords($result->getData()->data);
}
```

#### Helper function:

```php
public function index()
{
    $result = speller('Helllo world!');
    // Do whatever you want with results
    // $this->someService->swapWords($result->getData()->data);
}
```

## Advanced usage

Both `check()` and `response()` methods accept four parameters:

-   `string | array $text` text sting or array of strings to check spelling
-   `string | null $lang` used to rewrite config defined $lang parameter, comma separated languages
-   `int | null $options` used to rewrite config defined $options parameter, sum of possible options
-   `string | null $format` used to rewrite config defined $format parameter, 'plain' or 'html'

## Configuration

If you need to customize the default config, you can do it directly on the `yandex-speller.php` configuration file.

| option  | default | description                                                                                                                                                                        |
| ------- | ------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| lang    | 'ru,en' | This option specifies the default languages of the text to be checked. The parameter value should be comma separated.                                                              |
| format  | 'plain' | This option specifies the default format of the text to be checked.                                                                                                                |
| options | 0       | This option specifies the behaviour of the API. The parameter value is the sum of the option values. Refer to: https://yandex.ru/dev/speller/doc/dg/reference/speller-options.html |

### Testing

```bash
composer test
```

## Roadmap

This package is basic wrapper to make call to Yandex Speller API, it is possible to use any parameters that Yandex Speller is supporting for now.
New Features may be made in case you find interesting use cases.

For example:

-   [ ] Wrap result to use in other methods.
-   [ ] Return text with suggestions applied.
-   [ ] etc...

### Changelog

<!-- TODO -->

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

<!-- TODO -->

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

-   [Ricards Tagils](https://github.com/fecony)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
