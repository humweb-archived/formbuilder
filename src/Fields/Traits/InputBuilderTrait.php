<?php

namespace Humweb\FormBuilder\Fields\Traits;

trait InputBuilderTrait
{

    /**
     * Create a form input field.
     *
     * @param  string $type
     *
     * @return string
     */
    public function input($type)
    {
        $this->setAttribute('type', $type);
        $this->setAttribute('name', $this->name);
        $this->setAttribute('value', $this->value);

        return '<input '.$this->renderAttributes().' />';
    }

}
