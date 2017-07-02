<?php

namespace ZFort\Seoable\Fields\Meta;

class TitleSeparator extends Field
{
    protected function parseValue($value): string
    {
        return $value;
    }
}
