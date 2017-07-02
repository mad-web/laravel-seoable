<?php

namespace ZFort\Seoable\Models;

use Illuminate\Database\Eloquent\Model;
use ZFort\Seoable\Contracts\SeoDataContract;

class SeoData extends Model implements SeoDataContract
{
    /**
     * @var array
     */
    protected $fillable = [
        'meta',
        'open_graph',
        'twitter'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'meta' => 'object',
        'open_graph' => 'object',
        'twitter' => 'object',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('seoable.table_names.seo_data'));
    }

    public function seoable()
    {
        return $this->morphTo();
    }

    public function getMeta()
    {
        return $this->getAttribute('meta');
    }

    public function getOpenGraph()
    {
        return $this->getAttribute('open_graph');
    }

    public function getTwitterCard()
    {
        return $this->getAttribute('twitter_card');
    }

    public function getSeoData()//TODO: refactor
    {
        $meta = $this->getMeta();
        $open_graph = $this->getOpenGraph();
        $twitter_card = $this->getTwitterCard();

        if (! empty($open_graph)) {
            $meta += ['open_graph' => $open_graph];
        }

        if (! empty($twitter_card)) {
            $meta += ['twitter_card' => $twitter_card];
        }

        return $meta;
    }

    public function getSeoableModel(): string
    {
        return $this->seoable_type;
    }
}
