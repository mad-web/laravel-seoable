<?php

namespace MadWeb\Seoable\Fields\TwitterCard;

use MadWeb\Seoable\Fields\Field;

class Url extends Field
{
    protected function parseValue($value): string
    {
        return $this->model->getAttribute($value);
    }
}
