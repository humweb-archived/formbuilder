<?php

namespace Humweb\FormBuilder\Fields;

use Humweb\FormBuilder\Fields\Traits\InputBuilderTrait;

class TextField extends AbstractField
{
    use InputBuilderTrait;

    protected $fieldType = 'text';

    /**
     * Render the field.
     *
     * @return string
     */
    public function render()
    {
        return $this->input('text');
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
