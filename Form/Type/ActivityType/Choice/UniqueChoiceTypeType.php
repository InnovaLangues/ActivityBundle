<?php

namespace Innova\ActivityBundle\Form\Type\ActivityType\Choice;

class UniqueChoiceTypeType extends AbstractChoiceTypeType
{
    public function getName()
    {
        return 'innova_activity_type_unique';
    }

    public function getDefaultOptions()
    {
        return array (
            'data_class' => 'Innova\ActivityBundle\Entity\ActivityType\Choice\UniqueChoiceType',
        );
    }
}
