<?php

namespace MadWeb\Seoable\Fields\Meta;

use MadWeb\Seoable\Fields\Field;

class Keywords extends Field
{
    protected function parseValue($value): array
    {
        return $this->parseAttributes($value);
    }
}
