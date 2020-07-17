<?php

namespace MadWeb\Seoable\Protocols;

use MadWeb\Seoable\Fields\Meta\Canonical;
use MadWeb\Seoable\Fields\Meta\Description;
use MadWeb\Seoable\Fields\Meta\Keywords;
use MadWeb\Seoable\Fields\Meta\Languages;
use MadWeb\Seoable\Fields\Meta\MetaTag;
use MadWeb\Seoable\Fields\Meta\Next;
use MadWeb\Seoable\Fields\Meta\Prev;
use MadWeb\Seoable\Fields\Meta\Title;
use MadWeb\Seoable\Fields\Meta\TitleSeparator;

/**
 * @method Meta setMetaRaw(array $value)
 * @method Meta addMetaRaw(string $meta, string $value, string $name = 'name')
 * @method Meta setTitleRaw(string $value)
 * @method Meta setTitleSeparatorRaw(string $value)
 * @method Meta setDescriptionRaw(string $value)
 * @method Meta setCanonicalRaw(string $value)
 * @method Meta setPrevRaw(string $value)
 * @method Meta setNextRaw(string $value)
 * @method Meta setKeywordsRaw(array|string $value)
 * @method Meta setLanguagesRaw(array $value)
 * @method Meta addLanguageRaw(string $lang, string $url)
 */
class Meta extends Protocol
{
    public function setMeta(array $tags): self
    {
        foreach ($this->parseValue($tags, MetaTag::class) as $item) {
            $this->metaService->addMeta(...array_values($item));
        }

        return $this;
    }

    public function addMeta(string $meta, string $value, string $name = 'name'): self
    {
        $this->metaService->addMeta(...array_values(
            $this->parseValue(
                [compact('meta', 'value', 'name')],
                MetaTag::class
            )[0]
        ));

        return $this;
    }

    /** @param array|string $value */
    public function setTitle($value, string $templateKey = ''): self
    {
        $this->seoTools->setTitle($this->parseValue(
            $value,
            $templateKey ? new Title($value, $this->model, $templateKey) : Title::class
        ));

        return $this;
    }

    /** @param string $value */
    public function setTitleSeparator(string $value): self
    {
        $this->metaService->setTitleSeparator($this->parseValue($value, TitleSeparator::class));

        return $this;
    }

    /** @param array|string $value */
    public function setDescription($value, string $templateKey = ''): self
    {
        $this->seoTools->setDescription($this->parseValue(
            $value,
            $templateKey ? new Description($value, $this->model, $templateKey) : Description::class
        ));

        return $this;
    }

    public function setCanonical(string $value): self
    {
        $this->seoTools->setCanonical($this->parseValue($value, Canonical::class));

        return $this;
    }

    public function setPrev(string $value): self
    {
        $this->metaService->setPrev($this->parseValue($value, Prev::class));

        return $this;
    }

    public function setNext(string $value): self
    {
        $this->metaService->setNext($this->parseValue($value, Next::class));

        return $this;
    }

    /** @param array|string $value */
    public function setKeywords($value): self
    {
        $this->metaService->setKeywords($this->parseValue($value, Keywords::class));

        return $this;
    }

    public function setLanguages(array $value): self
    {
        $this->metaService->addAlternateLanguages($this->parseValue($value, Languages::class));

        return $this;
    }

    public function addLanguage(string $lang, string $url): self
    {
        $this->metaService->addAlternateLanguage(...array_values(
            $this->parseValue(
                [compact('lang', 'url')],
                Languages::class
            )[0]
        ));

        return $this;
    }

    protected function getRawFields(): array
    {
        return $this->modelSeoData;
    }
}
