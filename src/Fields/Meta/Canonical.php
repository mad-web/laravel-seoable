<?php

namespace ZFort\Seoable\Fields\Meta;

use ZFort\Seoable\Fields\Field;

class Canonical extends Field
{
    protected function parseValue($value): string
    {
        return $this->model->getAttribute($value);
    }
}
