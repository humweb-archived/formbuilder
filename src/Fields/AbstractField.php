<?php

namespace Humweb\FormBuilder\Fields;

use Humweb\FormBuilder\Fields\Traits\AttributableTrait;

abstract class AbstractField
{
    use AttributableTrait;

    protected $name = '';
    protected $value = '';
    protected $fieldType = '';

    /**
     * AbstractField constructor.
     *
     * @param string $name
     * @param string $value
     * @param array  $attributes
     */
    public function __construct($name, $value = '', array $attributes = [])
    {
        $this->name = $name;
        $this->value = $value;
        $this->attributes = $attributes;
    }

    /**
     * Render the field.
     *
     * @return string
     */
    abstract public function render();

    /**
     * Render the value.
     *
     * @return string
     */
    abstract public function renderValue();

    /**
     * Get field name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return AbstractField
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return AbstractField
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->fieldType;
    }

    public function addClass($class)
    {
        if (isset($this->attributes['class'])) {
            $class = $this->attributes['class'].' '.$class;
        }

        $this->setAttribute('class', $class);

        return $this;
    }

    public function removeClass($class)
    {
        $this->pluckAttributeValue('class', $class);

        return $this;
    }

    public function __toString()
    {
        return $this->render();
    }
}
