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

class Submit extends Input
{
    /**
     * @param bool $showErrors
     * @return string
     */
    public function __invoke(bool $showErrors): string
    {
        if ($showErrors && ($error = $this->input->getError()) !== null) {
            $error = '<div class="error mt-2 text-danger">' . $error . '</div>';
        } else {
            $error = '';
        }

        $template = '{{ template }} ' . $error;

        return (string) $this->input
            ->setTemplate($template)
            ->setAttribute('class', 'btn btn-primary float-right mt-2');
    }
}
