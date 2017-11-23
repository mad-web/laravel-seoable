<?php

namespace MadWeb\Seoable\Traits;

use MadWeb\Seoable\Protocols\Meta;

/**
 * This trait is for usage in models.
 */
trait SeoableTrait
{
    /**
     * Has one polymorphic relation to seo storage table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seoData()
    {
        return $this->morphOne(config('seoable.model'), 'seoable');
    }

    /**
     * Get seo data from the table.
     *
     * @return mixed
     */
    public function getSeoData()
    {
        return $this->seoData()->exists() ? $this->seoData->getSeoData() : [];
    }

    protected function seo()
    {
        return new Meta($this);
    }
}
