<?php

namespace Humweb\FormBuilder\tests\Fakes\OtherFields;

use Humweb\FormBuilder\Fields\AbstractField;

class HiddenField extends AbstractField
{
    protected $fieldType = 'hidden';

    /**
     * Render the field.
     *
     * @return string
     */
    public function render()
    {
        $this->setAttribute('type', $this->fieldType);
        $this->setAttribute('value', $this->getValue());
        $this->setAttribute('name', $this->getName());

        return '<input '.$this->renderAttributes().' />';
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
