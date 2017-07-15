<?php

namespace ZFort\Seoable\Fields\OpenGraph;

use ZFort\Seoable\Fields\Field;
use ZFort\Seoable\Fields\WithTemplates;

class Title extends Field
{
    use WithTemplates;

    protected function parseValue($value): string
    {
        return trans(
            $this->getTemplatePath(get_class($this->model).'.open_graph'),
            $this->parseAttributesWithKeys($value)
        );
    }
}
