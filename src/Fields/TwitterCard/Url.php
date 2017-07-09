<?php

namespace ZFort\Seoable\Fields\TwitterCard;

use ZFort\Seoable\Fields\Field;

class Url extends Field
{
    protected function parseValue($value): string
    {
        return $this->model->getAttribute($value);
    }
}
