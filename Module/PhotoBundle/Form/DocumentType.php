<?php

namespace Smc\Module\PhotoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', null, array("label" => "Nom du fichier"))
            ->add('fichier')
        ;
    }

    public function getName()
    {
        return 'smc_module_photobundle_documenttype';
    }
	
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Smc\Module\PhotoBundle\Entity\Document',
        );
    }
}
