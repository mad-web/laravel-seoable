<?php

namespace ZFort\Seoable\Protocols;

use ZFort\Seoable\Fields\TwitterCard\Url;
use ZFort\Seoable\Fields\TwitterCard\Site;
use ZFort\Seoable\Fields\TwitterCard\Type;
use ZFort\Seoable\Fields\TwitterCard\Title;
use ZFort\Seoable\Fields\TwitterCard\Images;
use ZFort\Seoable\Fields\TwitterCard\Values;
use ZFort\Seoable\Fields\TwitterCard\Description;

/**
 * @method TwitterCard setTitleRaw(array|string $value)
 * @method TwitterCard setDescriptionRaw(array|string $value)
 * @method TwitterCard setUrlRaw(string $value)
 * @method TwitterCard setSiteRaw(string $value)
 * @method TwitterCard setTypeRaw(string $value)
 * @method TwitterCard setImagesRaw(array|string $value)
 * @method TwitterCard addImageRaw(string $url)
 * @method TwitterCard setValuesRaw(array $value)
 * @method TwitterCard addValueRaw(string $key, mixed $value)
 */
class TwitterCard extends Protocol
{
    /**
     * @param array|string $value
     */
    public function setTitle($value): self
    {
        $this->twitterCardService->setTitle($this->parseValue($value, Title::class));

        return $this;
    }

    /**
     * @param array|string $value
     */
    public function setDescription($value): self
    {
        $this->twitterCardService->setDescription($this->parseValue($value, Description::class));

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

    /**
     * @param array|string $value
     */
    public function setImages($value): self
    {
        $this->twitterCardService->setImages($this->parseValue($value, Images::class));

        return $this;
    }

    public function addImage(string $url): self
    {
        $this->twitterCardService->setImages(
            $this->parseValue($url, Images::class)
        );

        return $this;
    }

    public function setValues(array $value): self
    {
        foreach ($this->parseValue($value, Values::class) as $item) {
            $this->twitterCardService->addValue(...array_values($item));
        }

        return $this;
    }

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
        return $this->modelSeoData['twitter_card'];
    }
}
