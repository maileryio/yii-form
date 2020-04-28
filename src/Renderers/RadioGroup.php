<?php

namespace Mailery\Widget\Form\Renderers;

use FormManager\Groups\RadioGroup as FormRadioGroup;

class RadioGroup
{
    /**
     * @var FormRadioGroup
     */
    private FormRadioGroup $radioGroup;

    /**
     * @param FormRadioGroup $radioGroup
     */
    public function __construct(FormRadioGroup $radioGroup)
    {
        $this->radioGroup = $radioGroup;
    }

    /**
     * @param bool $showErrors
     * @return string
     */
    public function __invoke(bool $showErrors): string
    {
        $placeholders = [
            '{{ error }}' => '',
        ];

        $template = strtr(
            '<div class="form-check">'
                . '{{ input }} {{ label }} {{ error }}'
            . '</div>',
            $placeholders
        );

        foreach ($this->radioGroup as $radio) {
            $radio
                ->setTemplate($template)
                ->setAttribute('class', 'form-check-input');
        }

        return '<div class="form-group row">'
            . '<div class="col-sm-4 col-form-label">' . $this->radioGroup->getLabel() . '</div> '
            . '<div class="col-sm-8">'
                . $this->radioGroup
            . '</div>'
        . '</div>';
    }
}