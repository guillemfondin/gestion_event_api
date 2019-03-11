<?php

namespace App\Service;

use Symfony\Component\Form\AbstractType;

class ConfigurationType extends AbstractType
{
    /**
     * Permet d'avoir la config de base d'un champs
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    protected function getConfig($label, $placeholder, $options = []) {
        return array_merge_recursive([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }
}