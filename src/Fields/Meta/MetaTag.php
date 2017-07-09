<?php

namespace ZFort\Seoable\Fields\Meta;

use ZFort\Seoable\Fields\Field;

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
