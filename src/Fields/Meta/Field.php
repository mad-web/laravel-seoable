<?php

namespace ZFort\Seoable\Fields\Meta;

abstract class Field
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var string|array
     */
    protected $value;

    public function __construct($value, $model)
    {
        $this->model = $model;
        $this->value = $this->parseValue($value);
    }

    protected function parseAttributesWithKeys($attributes)
    {
        $result = [];
        if (is_array($attributes)) {
            foreach ($attributes as $key => $field) {
                $value = $this->model->getAttribute($field);
                if (is_numeric($key)) {
                    $result[$field] = $value;
                } else {
                    $result[$key] = $value;
                }
            }
        } else {
            $result[$attributes] = $this->model->getAttribute($attributes);
        }

        return $result;
    }

    protected function parseAttributes($attributes)
    {
        $result = [];
        if (is_array($attributes)) {
            foreach ($attributes as $key => $field) {
                $result[] = $this->model->getAttribute($field);
            }
        } else {
            return $this->model->getAttribute($attributes);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    abstract protected function parseValue($value);
}
