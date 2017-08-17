<?php

namespace MadWeb\Seoable\Fields\OpenGraph;

use MadWeb\Seoable\Fields\TemplatableField;

class Title extends TemplatableField
{
    protected function getNestingLevel(): string
    {
        return 'open_graph';
    }
}
