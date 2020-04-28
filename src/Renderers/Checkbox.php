<?php

namespace Mailery\Widget\Form\Renderers;

class Checkbox extends Input
{
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
            '<div class="form-group row"><div class="col-sm-4 col-form-label">{{ label }}</div> <div class="col-sm-8"><div class="form-check">{{ input }} {{ error }}</div></div></div>',
            $placeholders
        );

        return $this->input
            ->setTemplate($template)
            ->setAttribute('class', 'form-check-input');
    }
}
