<?php

namespace Mailery\Widget\Form\Renderers;

class Submit extends Input
{
    /**
     * @param bool $showErrors
     * @return string
     */
    public function __invoke(bool $showErrors): string
    {
        return $this->input
            ->setTemplate('{{ template }}')
            ->setAttribute('class', 'btn btn-primary float-right mt-2');
    }
}
