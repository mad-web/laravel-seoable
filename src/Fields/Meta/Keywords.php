<?php

namespace ZFort\Seoable\Fields\Meta;

use ZFort\Seoable\Fields\Field;

class Keywords extends Field
{
    protected function parseValue($value): array
    {
        return $this->parseAttributes($value);
    }
}
