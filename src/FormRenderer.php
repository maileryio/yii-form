<?php

declare(strict_types=1);

/**
 * Form view for Yii3 framework
 * @link      https://github.com/maileryio/yii-form
 * @package   Mailery/Form
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2020, Mailery (https://mailery.io/)
 */

namespace Mailery\Form;

use FormManager\Form;
use FormManager\Inputs\Input;
use FormManager\Inputs\Submit;

class FormRenderer
{
    /**
     * @param Form $form
     * @param bool $showErrors
     * @return string
     */
    public function __invoke(Form $form, bool $showErrors): string
    {
        $rows = [];

        foreach ($form as $input) {
            /* @var $input Input */
            $input = clone $input;

            if ($input instanceof Submit) {
                $cssClasses = [
                    'btn',
                    'btn-primary',
                    'float-right',
                    'mt-2',
                ];
                $template = '{{ template }}';
            } else {
                $cssClasses = [
                    'form-control',
                ];
                $placeholders = [
                    '{{ error }}' => '',
                ];

                if ($showErrors && ($error = $input->getError()) !== null) {
                    $cssClasses[] = 'form-control-danger';
                    $placeholders['{{ error }}'] = '<div class="error mt-2 text-danger">' . $error . '</div>';
                }

                $template = strtr(
                    '<div class="form-group row"><div class="col-sm-4 col-form-label">{{ label }}</div> <div class="col-sm-8">{{ input }} {{ error }}</div></div>',
                    $placeholders
                );
            }

            $input
                ->setTemplate($template)
                ->setAttribute('class', implode(' ', $cssClasses));

            $rows[] = strtr(
                '<div class="row"><div class="col-md-12">{input}</div></div>',
                [
                    '{input}' => $input,
                ]
            );
        }

        return $form->getOpeningTag() . implode("\n", $rows) . $form->getClosingTag();
    }
}
