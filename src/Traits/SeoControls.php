<?php

namespace ZFort\Seoable\Traits;

use Artesaos\SEOTools\Traits\SEOTools;
use ZFort\Seoable\Contracts\Seoable;

/**
 * This trait is for usage with controllers
 */
trait SeoControls
{
    use SEOTools;

    public function seoModel(Seoable $model)
    {
        $model->seoable(); //TODO: do something
    }
}
