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

use FormManager\Inputs\Submit as SubmitInput;

class Submit
{
    /**
     * @var SubmitInput
     */
    protected SubmitInput $input;

    /**
     * @param SubmitInput $input
     */
    public function __construct(SubmitInput $input)
    {
        $this->input = $input;
    }

    /**
     * @return string
     */
    public function __invoke(): string
    {
        return (string) $this->input
            ->setAttribute('class', 'btn btn-primary float-right mt-2');
    }
}
