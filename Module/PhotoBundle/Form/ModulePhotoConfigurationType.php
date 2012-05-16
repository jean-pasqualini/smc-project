<?php

namespace Smc\Module\PhotoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ModulePhotoConfigurationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('largeur')
			->add('hauteur')
			->add('document', new DocumentType)
        ;
    }

    public function getName()
    {
        return 'smc_module_photobundle_modulephotoconfigurationtype';
    }
	
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Smc\Module\PhotoBundle\Entity\ModulePhotoConfiguration',
        );
    }
}
