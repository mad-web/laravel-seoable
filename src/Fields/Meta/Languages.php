<?php

namespace ZFort\Seoable\Fields\Meta;

use ZFort\Seoable\Fields\Field;

class Languages extends Field
{
    protected function parseValue($value): array
    {
        foreach ($value as &$language) {
            $language['url'] = $this->model->getAttribute($language['url']);
        }

        return $value;
    }
}
