<?php

namespace Innova\ActivityBundle\Form\Type\ActivityProperty;

use Symfony\Component\Form\FormBuilderInterface;

class InstructionPropertyType extends AbstractPropertyType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('position');
    }
    
    public function getDefaultOptions()
    {
        return array (
            'data_class' => 'Innova\ActivityBundle\Entity\ActivityProperty\InstructionProperty',
        );
    }

    public function getName()
    {
        return 'innova_activity_prop_instruction';
    }
}
