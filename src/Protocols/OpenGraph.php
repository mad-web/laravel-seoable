<?php

namespace MadWeb\Seoable\Protocols;

use MadWeb\Seoable\Fields\OpenGraph\Description;
use MadWeb\Seoable\Fields\OpenGraph\Images;
use MadWeb\Seoable\Fields\OpenGraph\Properties;
use MadWeb\Seoable\Fields\OpenGraph\SiteName;
use MadWeb\Seoable\Fields\OpenGraph\Title;
use MadWeb\Seoable\Fields\OpenGraph\Url;

/**
 * @method OpenGraph setTitleRaw(string $title)
 * @method OpenGraph setDescriptionRaw(string $description)
 * @method OpenGraph setUrlRaw(string $url)
 * @method OpenGraph setSiteNameRaw(string $name)
 * @method OpenGraph setImagesRaw(array|string $images)
 * @method OpenGraph setPropertiesRaw(array $properties)
 * @method OpenGraph addPropertyRaw(string $key, mixed $value)
 */
class OpenGraph extends Protocol
{
    /** @param array|string $value */
    public function setTitle($value, string $templateKey = ''): self
    {
        $this->openGraphService->setTitle($this->parseValue(
            $value,
            $templateKey ? new Title($value, $this->model, $templateKey) : Title::class
        ));

        return $this;
    }

    /** @param array|string $value */
    public function setDescription($value, string $templateKey = ''): self
    {
        $this->openGraphService->setDescription($this->parseValue(
            $value,
            $templateKey ? new Description($value, $this->model, $templateKey) : Description::class
        ));

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

    /** @param array|string $images */
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

    /** @param array|string $value */
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
        return $this->modelSeoData['open_graph'] ?? [];
    }
}
