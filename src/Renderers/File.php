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

use FormManager\Inputs\File as FileInput;

class File
{
    /**
     * @var FileInput
     */
    protected FileInput $input;

    /**
     * @param FileInput $input
     */
    public function __construct(FileInput $input)
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
            'form-control-file',
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
