<?php

namespace ZFort\Seoable\Models;

use Illuminate\Database\Eloquent\Model;

class SeoData extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('seoable.table_names.seo_data'));
    }
}
