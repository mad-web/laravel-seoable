<?php

namespace MadWeb\Seoable\Fields\Meta;

use MadWeb\Seoable\Fields\Field;

class Canonical extends Field
{
    protected function parseValue($value): string
    {
        return $this->model->getAttribute($value);
    }
}
