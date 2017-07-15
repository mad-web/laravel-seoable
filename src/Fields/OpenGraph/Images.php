<?php

namespace ZFort\Seoable\Fields\OpenGraph;

use ZFort\Seoable\Fields\Field;

class Images extends Field
{
    protected function parseValue($value)
    {
        return $this->parseAttributes($value);
    }
}
