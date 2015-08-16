<?php

namespace Humweb\FormBuilder\Fields\Traits;

trait InputBuilderTrait
{

    /**
     * Create a form input field.
     *
     * @param  string  $type
     * @return string
     */
    public function input($type)
    {
        $this->setAttribute('type', $type);
        $this->setAttribute('value', $this->value);
        $this->setAttribute('name', $this->name);

        return $selfClosing ? '<input'.$this->renderAttributes().' />';
    }

}