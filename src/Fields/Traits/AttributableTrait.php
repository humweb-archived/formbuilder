<?php

namespace Humweb\FormBuilder\Fields\Traits;

trait AttributableTrait
{
    protected $attributes = [];

    /**
     * Append Attribute.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function appendAttribute($key, $value = null)
    {
        if (isset($this->attributes[$key])) {
            $this->attributes[$key] .= ' '.$value;
        } else {
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    /**
     * Shortcut for get/set attribute methods.
     *
     * @param      $key
     * @param null $value
     *
     * @return $this|string|null
     */
    public function attribute($key, $value = null)
    {
        if (is_null($value)) {
            return $this->getAttribute($key);
        }

        $this->setAttribute($key, $value);

        return $this;
    }

    /**
     * Get attribute value.
     *
     * @param $key
     *
     * @return string|null
     */
    public function getAttribute($key)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : null;
    }

    /**
     * Set attribute value.
     *
     * @param      $key
     * @param null $value
     *
     * @return $this
     */
    public function setAttribute($key, $value = null)
    {
        if (!is_null($value)) {
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    /**
     * Pluck a value/string from an attributes value.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function pluckAttributeValue($key, $value)
    {
        if (!isset($this->attributes[$key])) {
            return $this;
        }

        $re = [' '.$value, $value.' ', $value];
        $value = trim(str_replace($re, '', $this->attributes[$key]));

        if ($value == '') {
            $this->removeAttribute($key);
        } else {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    /**
     * Remove a value.
     *
     * @param string|null $key
     *
     * @return $this
     */
    public function removeAttribute($key = null)
    {
        if (isset($this->attributes[$key])) {
            unset($this->attributes[$key]);
        }

        return $this;
    }

    /**
     * Render attributes to key/value string.
     *
     * @return string
     */
    public function renderAttributes()
    {
        $result = '';
        foreach ($this->attributes as $key => $value) {
            $result .= " {$key}=\"{$value}\"";
        }

        return trim($result);
    }
}
