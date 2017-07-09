<?php

namespace ZFort\Seoable\Protocols;

class OpenGraph extends Protocol
{
    public function setTitle($value)
    {

    }

    public function setDescription($value)
    {

    }

    public function setUrl($value)
    {

    }

    public function setSiteName($value)
    {

    }

    public function setImages($value)
    {

    }

    public function setProperties($value)

    {

    }

    protected function getRawFields(): array
    {
        return $this->modelSeoData['open_graph'];
    }
}
