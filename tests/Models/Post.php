<?php

namespace MadWeb\Seoable\Test\Models;

use MadWeb\Seoable\Contracts\Seoable;
use MadWeb\Seoable\Traits\SeoableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Post extends Authenticatable implements Seoable
{
    use SeoableTrait;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'description', 'image',
    ];

    public function seoable()
    {
        return $this->seo();
    }

    public function getCanonicalAttribute()
    {
        return 'http://seoable.url/canonical';
    }

    public function getPrevAttribute()
    {
        return 'http://seoable.url/prev';
    }

    public function getNextAttribute()
    {
        return 'http://seoable.url/next';
    }

    public function getKeywordsAttribute()
    {
        return ['some', 'fucking', 'values'];
    }

    public function getLangAttribute($value)
    {
        return 'http://soable.url/lang';
    }

    public function getUrlAttribute()
    {
        return 'http://seoable.url/url';
    }

    public function getSiteAttribute($value)
    {
        return 'http://seoable.url/';
    }

    public function getTypeAttribute()
    {
        return 'article_type';
    }
//    public function seoable()
//    {
//        return $this->seo()
//            ->setTitle(['name', 'avatar'])
//            ->setDescription('name')
//            ->setCanonical('avatar')
//            ->setPrev('name')
//            ->setNext('avatar')
//            ->setKeywords('keywords')
//            ->setLanguages([
//                [
//                    'lang' => 'ru',
//                    'url' => 'avatar'
//                ]
//            ])
//            ->addLanguage('en', 'avatar')
//            ->addMeta('foo', 'name')
//            ->setMetaRaw([
//                [
//                    'meta' => 'some',
//                    'value' => 'name'
//                ],
//                [
//                    'meta' => 'new',
//                    'value' => 'email'
//                ]
//            ])
//            ->twitter()
//            ->setTitleRaw('name')
//            ->setDescription(['name', 'avatar'], 'some_desc')
//            ->setUrl('avatar')
//            ->setSite('avatar')
//            ->setTypeRaw('article')
//            ->setImages(['avatar', 'avatar'])
//            ->addValue('foo', ['name', 'name'])
//            ->setValuesRaw([
//                [
//                    'key' => 'name',
//                    'value' => 'name'
//                ],
//                [
//                    'key' => 'some',
//                    'value' => 'avatar'
//                ]
//            ])
//            ->opengraph()
//            ->setTitle('name')
//            ->setDescription(['name', 'avatar'])
//            ->setUrl('avatar')
//            ->setSiteName('name')
//            ->setImages(['avatar', 'avatar'])
//            ->setProperties([
//                [
//                    'key' => 'name',
//                    'value' => 'name'
//                ],
//                [
//                    'key' => 'some',
//                    'value' => 'avatar'
//                ]
//            ])
//            ->addProperty('foo', ['name', 'name']);

//    }
}
