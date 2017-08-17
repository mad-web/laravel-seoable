<?php

namespace MadWeb\Seoable\Fields\Meta;

use MadWeb\Seoable\Fields\Field;

class MetaTag extends Field
{
    protected function parseValue($value): array
    {
        foreach ($value as &$tag) {
            $tag['value'] = $this->model->getAttribute($tag['value']);
        }

        return $value;
    }
}
