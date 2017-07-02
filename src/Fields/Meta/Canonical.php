<?php

namespace ZFort\Seoable\Fields\Meta;

class Canonical extends Field
{
    protected function parseValue($value): string
    {
        return $this->model->getAttribute($value);
    }
}
