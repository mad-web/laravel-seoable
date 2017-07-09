<?php

namespace ZFort\Seoable\Protocols;

use ZFort\Seoable\Fields\TwitterCard\Description;
use ZFort\Seoable\Fields\TwitterCard\Images;
use ZFort\Seoable\Fields\TwitterCard\Site;
use ZFort\Seoable\Fields\TwitterCard\Title;
use ZFort\Seoable\Fields\TwitterCard\Type;
use ZFort\Seoable\Fields\TwitterCard\Url;
use ZFort\Seoable\Fields\TwitterCard\Values;

class TwitterCard extends Protocol
{
    public function setTitle($value)
    {
        $this->twitterCardService->setTitle($this->parseValue($value, Title::class));

        return $this;
    }

    public function setDescription($value)
    {
        $this->twitterCardService->setDescription($this->parseValue($value, Description::class));

        return $this;
    }

    public function setUrl($value)
    {
        $this->twitterCardService->setUrl($this->parseValue($value, Url::class));

        return $this;
    }

    public function setSite($value)
    {
        $this->twitterCardService->setSite($this->parseValue($value, Site::class));

        return $this;
    }

    public function setType($value)
    {
        $this->twitterCardService->setType($this->parseValue($value, Type::class));

        return $this;
    }

    public function setImages($value)
    {
        $this->twitterCardService->setImages($this->parseValue($value, Images::class));

        return $this;
    }

    public function setValues($value)
    {
        foreach ($this->parseValue($value, Values::class) as $item) {
            $this->twitterCardService->addValue(...array_values($item));
        }

        return $this;
    }

    protected function getRawFields(): array
    {
        return $this->modelSeoData['twitter_card'];
    }
}
