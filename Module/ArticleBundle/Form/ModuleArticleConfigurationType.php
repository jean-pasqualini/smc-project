<?php

namespace Smc\Module\ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ModuleArticleConfigurationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('TitleBackgroundColor')
            ->add('TitlesTextColor');
    }

    public function getName()
    {
        return 'smc_module_articlebundle_modulearticleconfigurationtype';
    }
}
