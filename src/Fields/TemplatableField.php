<?php

namespace MadWeb\Seoable\Fields;

abstract class TemplatableField extends Field
{
    /** @var string */
    protected $templateKey;

    public function __construct($value, $model, string $templateKey = '')
    {
        $this->templateKey = $templateKey;

        parent::__construct($value, $model);
    }

    protected function parseValue($value): string
    {
        $nesting_level = $this->templateKey ?: $this->getNestingLevel();

        return trans(
            $this->getTemplatePath(
                get_class($this->model).
                ($nesting_level ? '.'.$nesting_level : '')
            ),
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
