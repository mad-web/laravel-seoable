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
    protected $modelSeoData;

    protected $metaService = null;
    protected $openGraphService = null;
    protected $twitterCardService = null;
    protected $seoTools = null;
    protected $isRaw = false;

    /**
     * Protocol constructor.
     * @param Model|\ZFort\Seoable\Contracts\Seoable $model
     */
    public function __construct(Seoable $model)//TODO: model refactor
    {
        $this->model = $model;
        $this->modelSeoData = (array) $this->model->getSeoData();

        $this->seoTools = resolve('seotools');
        $this->metaService = resolve('seotools.metatags');
        $this->openGraphService = resolve('seotools.opengraph');
        $this->twitterCardService = resolve('seotools.twitter'); //TODO: resolve method ability
    }

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

    /**
     * @return TwitterCard
     */
    public function twitter()
    {
        return new TwitterCard($this->model);
    }

    /**
     * @return OpenGraph
     */
    public function opengraph()
    {
        return new OpenGraph($this->model);
    }

    abstract protected function getRawFields(): array;
}
