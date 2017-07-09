<?php

namespace ZFort\Seoable\Fields;

trait WithTemplates
{
    protected function getTemplatePath($template_key)
    {
        return config('seoable.templates_path').
            '.'.$template_key.'.'.
            mb_strtolower(class_basename($this));
    }
}
