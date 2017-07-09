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
        'twitter',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
        'open_graph' => 'array',
        'twitter' => 'array',
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
        return $this->getAttribute('twitter');
    }

    public function getSeoData()//TODO: refactor
    {
        $meta = $this->getMeta();
        $open_graph = $this->getOpenGraph();
        $twitter_card = $this->getTwitterCard();

        $meta += ['open_graph' => ! empty($open_graph) ? $open_graph : []];

        $meta += ['twitter_card' => ! empty($twitter_card) ? $twitter_card : []];

        return $meta;
    }

    public function getSeoableModel(): string
    {
        return $this->seoable_type;
    }
}
