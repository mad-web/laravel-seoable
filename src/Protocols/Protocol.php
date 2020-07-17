<?php

namespace MadWeb\Seoable\Protocols;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use MadWeb\Seoable\Contracts\Seoable;
use MadWeb\Seoable\Fields\Field;

abstract class Protocol
{
    /** @var Model|\MadWeb\Seoable\Contracts\Seoable */
    protected $model;

    /** @var array */
    protected $modelSeoData;

    /** @var \Artesaos\SEOTools\SEOMeta */
    protected $metaService = null;

    /** @var \Artesaos\SEOTools\OpenGraph */
    protected $openGraphService = null;

    /** @var \Artesaos\SEOTools\TwitterCards */
    protected $twitterCardService = null;

    /** @var \Artesaos\SEOTools\SEOTools */
    protected $seoTools = null;

    protected $isRaw = false;

    protected $isStoredFieldsIgnores = false;

    /** @param Model|\MadWeb\Seoable\Contracts\Seoable $model */
    public function __construct(Seoable $model)
    {
        $this->model = $model;
        $this->modelSeoData = (array) $this->model->getSeoData();

        $this->seoTools = resolve('seotools');
        $this->metaService = resolve('seotools.metatags');
        $this->openGraphService = resolve('seotools.opengraph');
        $this->twitterCardService = resolve('seotools.twitter'); //TODO: resolve method ability
    }

    /**
     * @param array|string $value
     * @param \MadWeb\Seoable\Fields\Field|string $type
     * @return mixed
     */
    protected function parseValue($value, $type)
    {
        $raw_field = $this->isStoredFieldsIgnores ?
            null :
            $this->getRawFields()[Str::snake(class_basename($type))] ?? null;

        if (! $raw_field and ! $this->isRaw) {
            $type = $type instanceof Field ? $type : new $type($value, $this->model);
        }

        return $raw_field ?? ($this->isRaw ? $value : $type->getValue());
    }

    public function __call($name, $arguments)
    {
        if (Str::endsWith($name, 'Raw')) {
            $this->isRaw = true;
            $this->{mb_strstr($name, 'Raw', true)}(...$arguments);
            $this->isRaw = false;

            return $this;
        }

        throw new BadMethodCallException;
    }

    public function twitter(): TwitterCard
    {
        return new TwitterCard($this->model);
    }

    public function opengraph(): OpenGraph
    {
        return new OpenGraph($this->model);
    }

    public function meta(): Meta
    {
        return new Meta($this->model);
    }

    public function ignoreStored()
    {
        $this->isStoredFieldsIgnores = true;

        return $this;
    }

    abstract protected function getRawFields(): array;
}
