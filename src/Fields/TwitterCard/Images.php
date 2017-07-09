<?php

namespace ZFort\Seoable\Fields\TwitterCard;

use ZFort\Seoable\Fields\Field;

class Images extends Field
{
    protected function parseValue($value): array
    {
        return $this->parseAttributes($value);
    }
}
