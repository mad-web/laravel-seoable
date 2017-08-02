<?php

namespace ZFort\Seoable\Models;

use Illuminate\Database\Eloquent\Model;
use ZFort\Seoable\Contracts\SeoDataContract;

class SeoData extends Model implements SeoDataContract
{
    /** @var array */
    protected $fillable = [
        'meta',
        'open_graph',
        'twitter',
    ];

    /** @var array */
    protected $casts = [
        'meta' => 'array',
        'open_graph' => 'array',
        'twitter' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('seoable.seo_data_table'));
    }

    public function seoable()
    {
        return $this->morphTo();
    }

    public function getSeoData(): array
    {
        $meta = $this->meta;
        $open_graph = $this->open_graph;
        $twitter_card = $this->twitter_card;

        $meta += ['open_graph' => ! empty($open_graph) ? $open_graph : []];

        $meta += ['twitter_card' => ! empty($twitter_card) ? $twitter_card : []];

        return $meta;
    }

    public function getSeoableModel(): string
    {
        return $this->seoable_type;
    }
}
