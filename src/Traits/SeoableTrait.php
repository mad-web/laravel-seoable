<?php

namespace ZFort\Seoable\Traits;

use ZFort\Seoable\Protocols\Meta;

/**
 * This trait is for usage in models
 */
trait SeoableTrait
{
    /**
     * Has one polymorphic relation to seo storage table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seoData()
    {
        $class_name = get_class($this);

        $SeoDataQuery = $this->hasOne(config('seoable.model'), 'seoable_id')->where('seoable_type', $class_name);

        if (!$SeoDataQuery->exists()) {
            $SeoData = $SeoDataQuery->make(['meta' => [], 'open_graph' => [], 'twitter' => []]);
            $SeoData->seoable_type = $class_name;
            $SeoData->save();
        }

        return $SeoDataQuery;
    }

    /**
     * Get seo data from the table
     *
     * @return mixed
     */
    public function getSeoData()
    {
        return $this->seoData->getSeoData();
    }

    protected function seo()
    {
        return new Meta($this);
    }
}
