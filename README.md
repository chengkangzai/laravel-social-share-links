# A laravel package that generate social share link, that'ss all it does

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chengkangzai/laravel-social-share-links.svg?style=flat-square)](https://packagist.org/packages/chengkangzai/laravel-social-share-links)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/chengkangzai/laravel-social-share-links/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/chengkangzai/laravel-social-share-links/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/chengkangzai/laravel-social-share-links/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/chengkangzai/laravel-social-share-links/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/chengkangzai/laravel-social-share-links.svg?style=flat-square)](https://packagist.org/packages/chengkangzai/laravel-social-share-links)

## Installation

You can install the package via composer:

```bash
composer require chengkangzai/laravel-social-share-links
```

## Usage

#### Generate social share link for Single Social Media
```php
use Chengkangzai\LaravelSocialShareLinks\Enums\SocialMediaType;
use Chengkangzai\LaravelSocialShareLinks\SocialShareLinksBuilder;

$builder = new SocialShareLinksBuilder();
$link = $builder->url($url) // $url is optional, if not passed, it will use the current url
    ->facebook()
    ->build();

$facebookLink = $link[SocialMediaType::Facebook];
```

#### Generate social share links for Multiple Social Media
```php
use Chengkangzai\LaravelSocialShareLinks\Enums\SocialMediaType;
use Chengkangzai\LaravelSocialShareLinks\SocialShareLinksBuilder;

$builder = new SocialShareLinksBuilder();
$link = $builder->url($url)
    ->twitter()
    ->text('Hello World')
    ->hashtags(['laravel', 'social', 'share', 'links'])
    ->via('chengkangzai')
    ->build();

$twitterLink = $link[SocialMediaType::Twitter];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ching Cheng Kang](https://github.com/chengkangzai)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
