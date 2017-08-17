<?php

namespace MadWeb\Seoable\Fields\TwitterCard;

use MadWeb\Seoable\Fields\TemplatableField;

class Title extends TemplatableField
{
    protected function getNestingLevel(): string
    {
        return 'twitter_card';
    }
}
