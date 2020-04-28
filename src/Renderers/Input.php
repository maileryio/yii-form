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
     * @param bool $showErrors
     * @return string
     */
    public function __invoke(bool $showErrors): string
    {
        $placeholders = [
            '{{ error }}' => '',
        ];

        if ($showErrors && ($error = $this->input->getError()) !== null) {
            $placeholders['{{ error }}'] = '<div class="error mt-2 text-danger">' . $error . '</div>';
        }

        $template = strtr(
            '<div class="form-group row"><div class="col-sm-4 col-form-label">{{ label }}</div> <div class="col-sm-8">{{ input }} {{ error }}</div></div>',
            $placeholders
        );

        return $this->input
            ->setTemplate($template)
            ->setAttribute('class', 'form-control');
    }
}
