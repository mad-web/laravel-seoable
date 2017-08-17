<?php

namespace MadWeb\Seoable\Fields\OpenGraph;

use MadWeb\Seoable\Fields\Field;

class Images extends Field
{
    protected function parseValue($value)
    {
        return $this->parseAttributes($value);
    }
}
