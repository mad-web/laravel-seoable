<?php

namespace ZFort\Seoable\Protocols;

use ZFort\Seoable\Fields\OpenGraph\Url;
use ZFort\Seoable\Fields\OpenGraph\Title;
use ZFort\Seoable\Fields\OpenGraph\Images;
use ZFort\Seoable\Fields\OpenGraph\SiteName;
use ZFort\Seoable\Fields\OpenGraph\Properties;
use ZFort\Seoable\Fields\OpenGraph\Description;

/**
 * @method OpenGraph setTitleRaw(array|string $title)
 * @method OpenGraph setDescriptionRaw(array|string $description)
 * @method OpenGraph setUrlRaw(string $url)
 * @method OpenGraph setSiteNameRaw(string $name)
 * @method OpenGraph setImagesRaw(array|string $images)
 * @method OpenGraph setPropertiesRaw(array $properties)
 * @method OpenGraph addPropertyRaw(string $key, mixed $value)
 */
class OpenGraph extends Protocol
{
    /**
     * @param array|string $value
     */
    public function setTitle($value): self
    {
        $this->openGraphService->setTitle($this->parseValue($value, Title::class));

        return $this;
    }

    /**
     * @param array|string $value
     */
    public function setDescription($value): self
    {
        $this->openGraphService->setDescription($this->parseValue($value, Description::class));

        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->openGraphService->setUrl($this->parseValue($url, Url::class));

        return $this;
    }

    public function setSiteName(string $name): self
    {
        $this->openGraphService->setSiteName($this->parseValue($name, SiteName::class));

        return $this;
    }

    /**
     * @param array|string $images
     */
    public function setImages($images): self
    {
        $this->openGraphService->addImages([$this->parseValue($images, Images::class)]);

        return $this;
    }

    public function setProperties(array $properties): self
    {
        foreach ($this->parseValue($properties, Properties::class) as $item) {
            $this->openGraphService->addProperty(...array_values($item));
        }

        return $this;
    }

    /**
     * @param array|string $value
     */
    public function addProperty(string $key, $value): self
    {
        $this->openGraphService->addProperty(
            ...array_values(
                $this->parseValue([compact('key', 'value')], Properties::class)[0]
            )
        );

        return $this;
    }

    protected function getRawFields(): array
    {
        return $this->modelSeoData['open_graph'];
    }
}
