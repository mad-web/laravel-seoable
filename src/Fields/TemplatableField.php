<?php

namespace MadWeb\Seoable\Fields;

use Illuminate\Container\Container;

abstract class TemplatableField extends Field
{
    /** @var string */
    protected $templateKey;

    /** @var \Illuminate\Contracts\Translation\Translator */
    protected $translator;

    public function __construct($value, $model, string $templateKey = '')
    {
        $this->templateKey = $templateKey;
        $this->translator = Container::getInstance()->make('translator');

        parent::__construct($value, $model);
    }

    protected function parseValue($value): string
    {
        $nesting_level = $this->templateKey ?: $this->getNestingLevel();

        $template_path = $this->getTemplatePath(
            get_class($this->model).
            ($nesting_level ? '.'.$nesting_level : '')
        );

        return $this->translator->has($template_path) ? $this->translator->get(
            $template_path,
            $this->parseAttributesWithKeys($value)
        ) : $this->model->getAttribute($value);
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
