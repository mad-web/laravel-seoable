<?php

namespace ZFort\Seoable\Protocols;

use ZFort\Seoable\Fields\Meta\Canonical;
use ZFort\Seoable\Fields\Meta\MetaTag;
use ZFort\Seoable\Fields\Meta\Title;
use ZFort\Seoable\Fields\Meta\Description;
use ZFort\Seoable\Fields\Meta\Prev;
use ZFort\Seoable\Fields\Meta\Next;
use ZFort\Seoable\Fields\Meta\Keywords;
use ZFort\Seoable\Fields\Meta\Languages;
use ZFort\Seoable\Fields\Meta\TitleSeparator;

class Meta extends Protocol
{
    public function setTitle($value)
    {
        $this->seoTools->setTitle($this->parseValue($value, Title::class));
    }

    public function setTitleSeparator($value)
    {
        $this->metaService->setTitleSeparator($this->parseValue($value, TitleSeparator::class));
    }

    public function setDescription($value)
    {
        $this->seoTools->setDescription($this->parseValue($value, Description::class));
    }

    public function setCanonical($value)
    {
        $this->seoTools->setCanonical($this->parseValue($value, Canonical::class));
    }

    public function setPrev($value)
    {
        $this->metaService->setPrev($this->parseValue($value, Prev::class));
    }

    public function setNext($value)
    {
        $this->metaService->setNext($this->parseValue($value, Next::class));
    }

    public function setKeywords($value)
    {
        $this->metaService->setKeywords($this->parseValue($value, Keywords::class));
    }

    public function setLanguages($value)
    {
        $this->metaService->addAlternateLanguages($this->parseValue($value, Languages::class));
    }

    public function setMeta($value)
    {
        foreach ($this->parseValue($value, MetaTag::class) as $item) {
            $this->metaService->addMeta(...$item);
        }
    }
}
