<?php

namespace ZFort\Seoable\Fields\Meta;

class Prev extends Field
{
    protected function parseValue($value): string
    {
        return $this->model->getAttribute($value);
    }
}
