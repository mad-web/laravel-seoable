<?php

namespace MadWeb\Seoable\Fields\OpenGraph;

use MadWeb\Seoable\Fields\TemplatableField;

class Description extends TemplatableField
{
    protected function getNestingLevel(): string
    {
        return 'open_graph';
    }
}
