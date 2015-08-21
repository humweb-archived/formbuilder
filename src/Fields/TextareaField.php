<?php

namespace Humweb\FormBuilder\Fields;

class TextareaField extends AbstractField
{
    /**
     * Field type string
     *
     * @var string
     */
    protected $fieldType = 'textarea';

    /**
     * Attributes to skip while rendering
     *
     * @var array
     */
    protected $skipAttributes = ['value'];

    /**
     * Render the field.
     *
     * @return string
     */
    public function render()
    {
        $this->setAttribute('name', $this->name);

        return '<textarea '.$this->renderAttributes().'>'.$this->escapeHtml($this->value).'</textarea>';
    }

    /**
     * Render the value.
     *
     * @return string
     */
    public function renderValue()
    {
        return $this->value;
    }
}
