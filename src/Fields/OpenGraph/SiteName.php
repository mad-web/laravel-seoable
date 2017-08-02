<?php

namespace ZFort\Seoable\Fields\OpenGraph;

use ZFort\Seoable\Fields\Field;

class SiteName extends Field
{
    protected function parseValue($value): string
    {
        return $this->model->getAttribute($value);
    }
}
