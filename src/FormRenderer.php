<?php

declare(strict_types=1);

/**
 * Form Widget for Mailery Platform
 * @link      https://github.com/maileryio/widget-form
 * @package   Mailery\Widget\Form
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2020, Mailery (https://mailery.io/)
 */

namespace Mailery\Widget\Form;

use FormManager\Form;

class FormRenderer
{
    const NAMESPACES = [
        'Mailery\\Widget\\Form\\Renderers\\',
    ];

    /**
     * @var Form
     */
    private Form $form;

    /**
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * @param bool $showErrors
     * @return string
     */
    public function __invoke(bool $showErrors): string
    {
        $rows = [];
        foreach ($this->form as $input) {
            $inputRenderer = null;
            foreach (self::NAMESPACES as $namespace) {
                $name = (new \ReflectionClass($input))->getShortName();
                $class = $namespace . $name;

                if (class_exists($class)) {
                    $inputRenderer = new $class($input);
                }
            }

            if ($inputRenderer !== null) {
                $input = $inputRenderer($showErrors);
            }

            $rows[] = '<div class="row"><div class="col-md-12">' . $input . '</div></div>';
        }

        return $this->form->getOpeningTag()
            . implode("\n", $rows)
            . $this->form->getClosingTag();
    }
}
