<?php

namespace Humweb\FormBuilder\tests\Fakes\Fields;

use Humweb\FormBuilder\Fields\AbstractField;

/**
 * AbstractFieldFake.
 */
class AbstractFieldFake extends AbstractField
{
    protected $fieldType = 'text';

    /**
     * Render the field.
     *
     * @return string
     */
    public function render()
    {
        $this->setAttribute('type', 'text');
        $this->setAttribute('value', $this->value);
        $this->setAttribute('name', $this->name);

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
