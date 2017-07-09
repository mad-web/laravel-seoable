<?php

namespace ZFort\Seoable\Fields\TwitterCard;

use ZFort\Seoable\Fields\Field;

class Values extends Field
{
    protected function parseValue($value): array
    {
        foreach ($value as &$item) {
            $item['value'] = $this->model->getAttribute($item['value']);
        }

        return $value;
    }
}
