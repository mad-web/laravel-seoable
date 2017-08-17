<?php

namespace MadWeb\Seoable\Fields\TwitterCard;

use MadWeb\Seoable\Fields\TemplatableField;

class Description extends TemplatableField
{
    protected function getNestingLevel(): string
    {
        return 'twitter_card';
    }
}
