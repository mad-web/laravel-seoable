<?php

namespace ZFort\Seoable\Fields\TwitterCard;

use ZFort\Seoable\Fields\TemplatableField;

class Description extends TemplatableField
{
    protected function getNestingLevel(): string
    {
        return 'twitter_card';
    }
}
