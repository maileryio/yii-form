<?php

namespace Mailery\Widget\Form\Groups;

use FormManager\Groups\RadioGroup as FormRadioGroup;

class RadioGroup extends FormRadioGroup
{
    /**
     * @var string
     */
    private ?string $label = null;

    /**
     * @param string $label
     * @param iterable $radios
     */
    public function __construct(string $label = null, iterable $radios = [])
    {
        parent::__construct($radios);

        if (isset($label)) {
            $this->setLabel($label);
        }
    }

    /**
     * @param string $label
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }
}