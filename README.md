# Laravel Seoable

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-style]][link-style]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This package gives ability to
* Mapping your Eloquent attributes to SEO meta tags
* Set templates for _title_ and _description_ in lang file
* Save custom SEO data for any Model in your application

Working with:
* Meta tags
* Open Graph
* Twitter Card

Package based on [artesaos/seotools](https://github.com/artesaos/seotools), which provide ability to set meta tags in your template.

## Postcardware

You're free to use this package (it's [MIT-licensed](LICENSE.md)), but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

## Installation
You can install the package via composer:

_*For Laravel <= 5.4*_

```bash
composer require mad-web/laravel-seoable:1.0.0
```

_*For Laravel 5.5*_

```bash
composer require mad-web/laravel-seoable
```


_*For Laravel <= 5.4*_ - Now add the service provider in config/app.php file:
```php
'providers' => [
    // ...
    MadWeb\Seoable\SeoableServiceProvider::class,
];
```

You can publish the migration with:
```bash
$ php artisan vendor:publish --provider="MadWeb\Seoable\SeoableServiceProvider" --tag="migrations"
```

You can publish the config-file with:
```bash
$ php artisan vendor:publish --provider="MadWeb\Seoable\SeoableServiceProvider" --tag="config"
```

This is the contents of the published config/laravel-seoable.php config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Seo Data Table
    |--------------------------------------------------------------------------
    |
    | You can customize seo data storing table for your models
    */
    'seo_data_table' => 'seo_data',

    /*
    |--------------------------------------------------------------------------
    | Seo Data Templates Path
    |--------------------------------------------------------------------------
    |
    | Path to lang file where you can set property template
    |
    | Supported properties: "title", "description"
    */
    'templates_path' => 'seoable::seo',

    /*
    |--------------------------------------------------------------------------
    | Seo Data Model
    |--------------------------------------------------------------------------
    |
    | Model name for seo data table
    */
    'model' => \MadWeb\Seoable\Models\SeoData::class
];
```

To settings templates for _title_ and _description_ meta tags, you can publish the lang file by:
```bash
$ php artisan vendor:publish --provider="MadWeb\Seoable\SeoableServiceProvider" --tag="lang"
```
or set your own in `templates_path` config property
```php
/*
|--------------------------------------------------------------------------
| Seo Data Templates Path
|--------------------------------------------------------------------------
|
| Path to lang file where you can set property template
|
| Supported properties: "title", "description"
*/
'templates_path' => 'seoable::seo',
```

## Usage

The next step, you need to prepare your model by implementing the Interface,
use a Trait and implement `seoable()` method like this
```php
class User implements Seoable
{
    use SeoableTrait;
    ...
    
    public function seoable()
    {
    }
}
```

### Tags setting
Take the `seo()` method and setup fields by fluent api:
```php
public function seoable()
{
    $this->seo()
        ->setTitle('full_name')
        ->setDescription('full_name');
}
```

After that setup templates like in the next example:
```php
return [
    \App\User::class => [
        'title' => 'This is page title for user profile :full_name',
        'description' => 'This is page description for user profile :full_name',
        'twitter_card' => [
            'title' => 'Page title for twitter card :full_name',
            'description' => 'Page description for twitter card :full_name'
        ],
        'open_graph' => [
            'title' => 'Page title for open graph :full_name',
            'description' => 'Page description for open graph :full_name'
        ]
    ]
];
```
If you don't declare it, the field value will be used by default

Also you can set raw property by adding a Raw postfix to the any kind of method
```php
public function seoable()
{
    $this->seo()
        ->setTitleRaw('Some awesome title')
        ->setDescriptionRaw('Some awesome description');
}
```

You can pass multiple attributes and set custom names by putting an associative array
```php
public function seoable()
{
    $this->seo()
        ->setTitle(['name' => 'full_name', 'address' => 'email'])
        ->setDescription('full_name');
}
```
You have ability to save seo meta tags attached to the model by using `seoData()` relation
```php
$user = User::find(1)
$user->seoData->update(['meta' => ['title' => 'some title']]);
```
Stored tags has higher priority then tags set in `seoable()` method *

### Filling tags

In your controller you can call `seoable()` method like this
```php
public function show($post)
{
    $post->seoable()
    ...
}
```
If you want to override some meta tags
```php
public function show($post)
{
    $post->seoable()->meta()
    ->setTitleRaw('Some Post Title');
    ...
}
```
If you need to ignore stored tags in the database for the model
```php
public function show($post)
{
    $post->seoable()->meta()->ignoreStored()
    ->setTitleRaw('Some Post Title');
    ...
}
```

### Tags generating
Put the next row inside the `<head>` tag
```html
<head>
...
{!! resolve('seotools')->generate() !!}
...
</head>
```
or your can add Facade into the ```app.php``` config
```php
'aliases' => [
    // other Facades ommited
    'SEO' => Artesaos\SEOTools\Facades\SEOTools::class,
]
```
and use it instead of `resolve('seotools')`
```html
<head>
...
{!! SEO::generate() !!}
...
</head>
```
To set default meta tags values just publish SEOTools config
```php
php artisan vendor:publish --provider="Artesaos\SEOTools\Providers\SEOToolsServiceProvider"
```
You can find full usage documentation on [SEOTools Readme](https://github.com/spatie/laravel-permission/blob/master/README.md)

#### Full fluent api
```php
public function seoable()
{
    return $this->seo()
        ->setTitle(['name', 'email'])
        ->setDescription('name')
        ->setCanonical('url')
        ->setPrev('link')
        ->setNext('link')
        ->setKeywords('keywords')
        ->setLanguages([
            [
                'lang' => 'ru',
                'url' => 'lang_url' // Resolving by model attribute
            ]
        ])
        ->addLanguage('en', 'lang_url')
        ->addMeta('foo', 'bar')
        ->setMeta([
            [
                'meta' => 'some',
                'value' => 'name'
            ],
            [
                'meta' => 'another',
                'value' => 'tag'
            ]
        ])
        ->twitter()
            ->setTitle('name')
            ->setDescription('name')
            ->setUrl('url')
            ->setSite('site_name')
            ->setType('type')
            ->setImages(['avatar', 'image'])
            ->addValue('foo', ['name', 'name'])
            ->setValues([
                [
                    'key' => 'foo',
                    'value' => 'attribute'
                ],
                [
                    'key' => 'another',
                    'value' => 'another_attribute'
                ]
            ])
        ->opengraph()
            ->setTitle('name')
            ->setDescription(['name', 'email'])
            ->setUrl('url')
            ->setSiteName('site_name')
            ->setImages(['avatar', 'image'])
            ->setProperties([
                [
                    'key' => 'foo',
                    'value' => 'attribute'
                ],
                [
                    'key' => 'another',
                    'value' => 'another_attribute'
                ]
            ])
            ->addProperty('foo', ['name', 'email']);
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email madweb.dev@gmail.com instead of using the issue tracker.

## Credits

- [Mad Web](https://github.com/mad-web)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/mad-web/laravel-seoable.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/mad-web/laravel-seoable/master.svg?style=flat-square
[ico-style]: https://styleci.io/repos/100302677/shield
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/mad-web/laravel-seoable.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/mad-web/laravel-seoable.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/mad-web/laravel-seoable.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/mad-web/laravel-seoable
[link-travis]: https://travis-ci.org/mad-web/laravel-seoable
[link-scrutinizer]: https://scrutinizer-ci.com/g/mad-web/laravel-seoable/code-structure
[link-style]: https://styleci.io/repos/100302673
[link-code-quality]: https://scrutinizer-ci.com/g/mad-web/laravel-seoable
[link-downloads]: https://packagist.org/packages/mad-web/laravel-seoable
[link-author]: https://github.com/mad-web
[link-contributors]: ../../contributors