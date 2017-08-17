<?php

namespace MadWeb\Seoable\Fields\Meta;

use MadWeb\Seoable\Fields\Field;

class Next extends Field
{
    protected function parseValue($value): string
    {
        return $this->model->getAttribute($value);
    }
}
