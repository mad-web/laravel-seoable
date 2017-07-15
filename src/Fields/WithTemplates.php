<?php

namespace ZFort\Seoable\Fields;

trait WithTemplates
{
    protected function getTemplatePath(string $templateKey): string
    {
        return config('seoable.templates_path').
            '.'.$templateKey.'.'.
            mb_strtolower(class_basename($this));
    }
}
