<?php

namespace ZFort\Seoable\Fields\Meta;

class Languages extends Field
{
    protected function parseValue($value): array
    {
        foreach ($value as &$language) {
            $language['url'] = $this->model->getAttribute($language['url']);//TODO: CHECK RAW
        }

        return $value;
    }
}
