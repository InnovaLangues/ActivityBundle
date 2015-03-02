<?php

namespace Innova\ActivityBundle\Form\Type\ActivityProperty;

class InstructionPropertyType extends AbstractPropertyType
{
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
