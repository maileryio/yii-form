<?php

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
                    '<div class="form-group row"><div class="col-sm-3 col-form-label">{{ label }}</div> <div class="col-sm-9">{{ input }} {{ error }}</div></div>',
                    $placeholders
                );
            }

            $input
                ->setTemplate($template)
                ->setAttribute('class', implode(' ', $cssClasses));

            $rows[] = strtr(
                '<div class="row"><div class="col-md-6">{input}</div></div>',
                [
                    '{input}' => $input,
                ]
            );
        }

        return $form->getOpeningTag() . implode("\n", $rows) . $form->getClosingTag();
    }

}
