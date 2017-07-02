<?php

namespace ZFort\Seoable\Contracts;

interface Seoable
{
    public function seoable(): array;

    public function getSeoData();
}
