<?php

namespace ZFort\Seoable\Contracts;

interface SeoDataContract
{
    public function getSeoData();

    public function getMeta();

    public function getOpenGraph();

    public function getTwitterCard();

    public function getSeoableModel(): string;
}
