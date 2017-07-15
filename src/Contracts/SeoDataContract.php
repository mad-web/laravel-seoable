<?php

namespace ZFort\Seoable\Contracts;

interface SeoDataContract
{
    public function getSeoData(): array;

    public function getSeoableModel(): string;
}
