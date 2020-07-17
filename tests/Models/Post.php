<?php

namespace MadWeb\Seoable\Test\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use MadWeb\Seoable\Contracts\Seoable;
use MadWeb\Seoable\Traits\SeoableTrait;

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
}
