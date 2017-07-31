<?php

namespace ZFort\Seoable\Fields\TwitterCard;

use ZFort\Seoable\Fields\TemplatableField;

class Title extends TemplatableField
{
    protected function getNestingLevel(): string
    {
        return '.twitter_card';
    }
}
