<?php

namespace Smc\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('userRoles')
        ;
    }

    public function getName()
    {
        return 'smc_sitebundle_usertype';
    }
}
