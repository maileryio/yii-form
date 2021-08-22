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
use FormManager\InputInterface;

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
            if (($renderer = $this->resolveRenderer($input)) !== null) {
                $input = $renderer($showErrors);
            }

            $rows[] = '<div class="row"><div class="col-md-12">' . $input . '</div></div>';
        }

        return $this->form->getOpeningTag()
            . implode("\n", $rows)
            . $this->form->getClosingTag();
    }

    /**
     * @param InputInterface $input
     * @return callable|null
     */
    private function resolveRenderer(InputInterface $input): ?callable
    {
        if (method_exists($input, 'getRenderer')) {
            return $input->getRenderer();
        }

        foreach (self::NAMESPACES as $namespace) {
            $name = (new \ReflectionClass($input))->getShortName();
            $class = $namespace . $name;

            if (class_exists($class)) {
                return new $class($input);
            }
        }

        return null;
    }
}
