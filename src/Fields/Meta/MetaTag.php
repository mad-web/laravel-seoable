<?php

namespace ZFort\Seoable\Fields\Meta;

class MetaTag extends Field
{
    protected function parseValue($value): array
    {
        foreach ($value as &$tag) {
            $tag['value'] = $this->model->getAttribute($tag['value']);//TODO: CHECK RAW
            $tag = array_values($tag);
        }

        return $value;
    }
}
