<?php

namespace ZFort\Seoable\Traits;

use Artesaos\SEOTools\Traits\SEOTools;
use ZFort\Seoable\Contracts\Seoable;
use ZFort\Seoable\Services\SeoModelService;

/**
 * This trait is for usage with controllers
 */
trait SeoControls
{
    use SEOTools;

    public function seoModel(Seoable $model)
    {
        $SeoService = new SeoModelService($model);

        $SeoService->parseData();
    }
}
