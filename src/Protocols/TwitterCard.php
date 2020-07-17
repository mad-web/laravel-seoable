<?php

namespace MadWeb\Seoable\Protocols;

use MadWeb\Seoable\Fields\TwitterCard\Description;
use MadWeb\Seoable\Fields\TwitterCard\Images;
use MadWeb\Seoable\Fields\TwitterCard\Site;
use MadWeb\Seoable\Fields\TwitterCard\Title;
use MadWeb\Seoable\Fields\TwitterCard\Type;
use MadWeb\Seoable\Fields\TwitterCard\Url;
use MadWeb\Seoable\Fields\TwitterCard\Values;

/**
 * @method TwitterCard setTitleRaw(string $value)
 * @method TwitterCard setDescriptionRaw(string $value)
 * @method TwitterCard setUrlRaw(string $value)
 * @method TwitterCard setSiteRaw(string $value)
 * @method TwitterCard setTypeRaw(string $value)
 * @method TwitterCard setImagesRaw(array|string $value)
 * @method TwitterCard setValuesRaw(array $value)
 * @method TwitterCard addValueRaw(string $key, mixed $value)
 */
class TwitterCard extends Protocol
{
    /** @param array|string $value */
    public function setTitle($value, string $templateKey = ''): self
    {
        $this->twitterCardService->setTitle($this->parseValue(
            $value,
            $templateKey ? new Title($value, $this->model, $templateKey) : Title::class
        ));

        return $this;
    }

    /** @param array|string $value */
    public function setDescription($value, string $templateKey = ''): self
    {
        $this->twitterCardService->setDescription($this->parseValue(
            $value,
            $templateKey ? new Description($value, $this->model, $templateKey) : Description::class
        ));

        return $this;
    }

    public function setUrl(string $value): self
    {
        $this->twitterCardService->setUrl($this->parseValue($value, Url::class));

        return $this;
    }

    public function setSite(string $value): self
    {
        $this->twitterCardService->setSite($this->parseValue($value, Site::class));

        return $this;
    }

    public function setType(string $value): self
    {
        $this->twitterCardService->setType($this->parseValue($value, Type::class));

        return $this;
    }

    /** @param array|string $value */
    public function setImages($value): self
    {
        $this->twitterCardService->setImage($this->parseValue($value, Images::class));

        return $this;
    }

    public function setValues(array $value): self
    {
        foreach ($this->parseValue($value, Values::class) as $item) {
            $this->twitterCardService->addValue(...array_values($item));
        }

        return $this;
    }

    /** @param array|string $value */
    public function addValue(string $key, $value): self
    {
        $this->twitterCardService->addValue(
            ...array_values(
                $this->parseValue([compact('key', 'value')], Values::class)[0]
            )
        );

        return $this;
    }

    protected function getRawFields(): array
    {
        return $this->modelSeoData['twitter_card'] ?? [];
    }
}
