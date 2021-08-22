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

use FormManager\Inputs\Input as FormInput;

class Input
{
    /**
     * @var FormInput
     */
    protected FormInput $input;

    /**
     * @param FormInput $input
     */
    public function __construct(FormInput $input)
    {
        $this->input = $input;
    }

    /**
     * @param bool $submitted
     * @return string
     */
    public function __invoke(bool $submitted): string
    {
        $error = '';
        $inputClasses = [
            'form-control',
        ];

        if ($submitted) {
            if (($error = $this->input->getError()) !== null) {
                $error = '<div class="error mt-2 text-danger">' . $error . '</div>';
                $inputClasses[] = 'is-invalid';
            } else {
                $inputClasses[] = 'is-valid';
            }
        }

        if ($submitted && ($error = $this->input->getError()) !== null) {
            $error = '<div class="error mt-2 text-danger">' . $error . '</div>';
        }

        $template = '<div class="form-group row">'
            . '<div class="col-sm-4 col-form-label">{{ label }}</div>'
            . '<div class="col-sm-8">{{ input }} ' . $error . '</div>'
        . '</div>';

        return (string) $this->input
            ->setTemplate($template)
            ->setAttribute('class', implode(' ', $inputClasses));
    }
}
