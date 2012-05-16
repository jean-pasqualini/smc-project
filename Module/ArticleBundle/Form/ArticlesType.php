<?php

namespace Smc\Module\ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('placementId')
        ;
    }

    public function getName()
    {
        return 'smc_module_articlebundle_articlestype';
    }
}
