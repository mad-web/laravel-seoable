<?php

namespace ZFort\Seoable\Traits;

use ZFort\Seoable\Contracts\Seoable;
use Artesaos\SEOTools\Traits\SEOTools;

/**
 * This trait is for usage with controllers.
 */
trait SeoControls
{
    use SEOTools;

    public function seoModel(Seoable $model)
    {
        $model->seoable(); //TODO: do something
    }
}
