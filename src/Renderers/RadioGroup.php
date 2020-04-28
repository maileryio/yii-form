<?php

declare(strict_types=1);

/**
 * Form Widget for Mailery Platform
 * @link      https://github.com/maileryio/widget-form
 * @package   Mailery\Widget\Form
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2020, Mailery (https://mailery.io/)
 */

namespace Mailery\Widget\Form\Renderers;

use Mailery\Widget\Form\Groups\RadioGroup as FormRadioGroup;

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
     * @return string
     */
    public function __invoke(): string
    {
        $template = '<div class="form-check">{{ input }} {{ label }}</div>';

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
