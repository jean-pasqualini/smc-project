<?php

namespace Smc\Module\MenuBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ModuleMenuConfigurationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('BackgroundMenu')
            ->add('BackgroundItem')
            ->add('ColorTextItem');
    }

    public function getName()
    {
        return 'smc_module_menubundle_modulemenuconfigurationtype';
    }
}
