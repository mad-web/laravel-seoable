<?php

namespace ZFort\Seoable\Fields;

abstract class Field
{
    /** @var \Illuminate\Database\Eloquent\Model */
    protected $model;

    /** @var string|array */
    protected $value;

    public function __construct($value, $model)
    {
        $this->model = $model;
        $this->value = $this->parseValue($value);
    }

    /** @param array|string $attributes */
    protected function parseAttributesWithKeys($attributes): array
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

    /**
     * @param array|string $attributes
     * @return array|string
     */
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

    /** @return mixed */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param array|string $value
     * @return mixed
     */
    abstract protected function parseValue($value);
}
