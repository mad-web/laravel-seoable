<?php

namespace ZFort\Seoable\Fields\TwitterCard;

use ZFort\Seoable\Fields\Field;
use ZFort\Seoable\Fields\WithTemplates;

class Description extends Field
{
    use WithTemplates;

    protected function parseValue($value): string
    {
        return trans(
            $this->getTemplatePath(get_class($this->model).'.twitter_card'),
            $this->parseAttributesWithKeys($value)
        );
    }
}
