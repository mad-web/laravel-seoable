<?php

namespace ZFort\Seoable\Protocols;

use Illuminate\Database\Eloquent\Model;
use ZFort\Seoable\Exceptions\UndefinedFieldException;

abstract class Protocol //TODO: resolve by service container
{
    /**
     * @var Model|\ZFort\Seoable\Contracts\Seoable
     */
    protected $model;

    protected $metaService = null;
    protected $openGraphService = null;
    protected $twitterCardService = null;
    protected $seoTools = null;

    /**
     * @var bool
     */
    protected $isNeedPrepare;

    /**
     * Protocol constructor.
     * @param Model|\ZFort\Seoable\Contracts\Seoable $model
     * @param bool $isNeedPrepare
     */
    public function __construct(Model $model, bool $isNeedPrepare = true)//TODO: model refactor
    {
        $this->model = $model;
        $this->isNeedPrepare = $isNeedPrepare;

        $this->seoTools = resolve('seotools');
        $this->metaService = resolve('seotools.metatags');
        $this->openGraphService = resolve('seotools.opengraph');
        $this->twitterCardService = resolve('seotools.twitter');//TODO: resolve method ability
    }

    protected function parseValue($value, string $type)
    {
        return $this->isNeedPrepare ? (new $type($value, $this->model))->getValue() : $value;
    }

    public function __call($name, $arguments)
    {
        throw new UndefinedFieldException;
    }
}
