<?php

namespace Smc\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DesignType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fontFamilly')
            ->add('weight')
            ->add('fontSize')
            ->add('cornerRadius')
            ->add('backgroundColor')
            ->add('backgroundImage')
            ->add('borderColor')
            ->add('borderSize')
            ->add('textColor')
            ->add('paddingTop')
            ->add('paddingBottom')
            ->add('paddingLeft')
            ->add('paddingRight')
            ->add('marginTop')
            ->add('marginBottom')
            ->add('marginLeft')
            ->add('marginRight')
            ->add('borderType')
        ;
    }

    public function getName()
    {
        return 'smc_sitebundle_designtype';
    }
}
