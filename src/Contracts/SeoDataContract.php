<?php

namespace MadWeb\Seoable\Contracts;

interface SeoDataContract
{
    public function getSeoData(): array;

    public function getSeoableModel(): string;
}
