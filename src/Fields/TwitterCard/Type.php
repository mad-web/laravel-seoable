<?php

namespace ZFort\Seoable\Fields\TwitterCard;

use ZFort\Seoable\Fields\Field;

class Type extends Field
{
    protected function parseValue($value): string
    {
        return $this->model->getAttribute($value);
    }
}
