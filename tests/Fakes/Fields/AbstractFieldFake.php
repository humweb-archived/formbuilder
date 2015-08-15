<?php
use Humweb\FormBuilder\Fields\AbstractField;

/**
 * AbstractFieldFake
 *
 * @package ${NAMESPACE}
 */
class AbstractFieldFake extends AbstractField
{

    /**
     * Render the field
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
     * Render the value
     *
     * @return string
     */
    public function renderValue()
    {
        return $this->value;
    }
}