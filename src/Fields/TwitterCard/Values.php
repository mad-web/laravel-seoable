<?php

namespace MadWeb\Seoable\Fields\TwitterCard;

use MadWeb\Seoable\Fields\Field;

class Values extends Field
{
    protected function parseValue($value): array
    {
        foreach ($value as &$item) {
            if (is_array($item['value'])) {
                foreach ($item['value'] as &$property_value) {
                    $property_value = $this->model->getAttribute($property_value);
                }
            } else {
                $item['value'] = $this->model->getAttribute($item['value']);
            }
        }

        return $value;
    }
}
