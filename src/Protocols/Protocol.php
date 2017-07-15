<?php

namespace ZFort\Seoable\Protocols;

use BadMethodCallException;
use ZFort\Seoable\Contracts\Seoable;
use Illuminate\Database\Eloquent\Model;

abstract class Protocol
{
    /**
     * @var Model|\ZFort\Seoable\Contracts\Seoable
     */
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

    /** @param Model|\ZFort\Seoable\Contracts\Seoable $model */
    public function __construct(Seoable $model)//TODO: model refactor
    {
        $this->model = $model;
        $this->modelSeoData = (array) $this->model->getSeoData();

        $this->seoTools = resolve('seotools');
        $this->metaService = resolve('seotools.metatags');
        $this->openGraphService = resolve('seotools.opengraph');
        $this->twitterCardService = resolve('seotools.twitter'); //TODO: resolve method ability
    }

    /** @param array|string $value */
    protected function parseValue($value, string $type)
    {
        return $this->getRawFields()[snake_case(class_basename($type))] ??
            ($this->isRaw ? $value : (new $type($value, $this->model))->getValue());
    }

    public function __call($name, $arguments)
    {
        if (ends_with($name, 'Raw')) {
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

    abstract protected function getRawFields(): array;
}
