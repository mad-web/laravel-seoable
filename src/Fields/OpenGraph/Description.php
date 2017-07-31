<?php

namespace ZFort\Seoable\Fields\OpenGraph;

use ZFort\Seoable\Fields\TemplatableField;

class Description extends TemplatableField
{
    protected function getNestingLevel(): string
    {
        return '.open_graph';
    }
}
