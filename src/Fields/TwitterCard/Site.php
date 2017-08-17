<?php

namespace MadWeb\Seoable\Fields\TwitterCard;

use MadWeb\Seoable\Fields\Field;

class Site extends Field
{
    protected function parseValue($value): string
    {
        return $this->model->getAttribute($value);
    }
}
