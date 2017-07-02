<?php

namespace ZFort\Seoable\Fields\Meta;

class Keywords extends Field
{
    protected function parseValue($value): array
    {
        return $this->parseAttributes($value);
    }
}
