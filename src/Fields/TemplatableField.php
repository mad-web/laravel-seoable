<?php

namespace ZFort\Seoable\Fields;


abstract class TemplatableField extends Field
{
    /** @var string */
    protected $templateKey;

    public function __construct($value, $model, string $templateKey = '')
    {
        parent::__construct($value, $model);

        $this->templateKey = $templateKey;
    }

    protected function parseValue($value): string
    {
        return trans(
            $this->templateKey ?: $this->getTemplatePath(get_class($this->model) . $this->getNestingLevel()),
            $this->parseAttributesWithKeys($value)
        );
    }

    protected function getTemplatePath(string $templateKey): string
    {
        return config('seoable.templates_path').
            '.'.$templateKey.'.'.
            mb_strtolower(class_basename($this));
    }

    protected function getNestingLevel(): string
    {
        return '';
    }
}
