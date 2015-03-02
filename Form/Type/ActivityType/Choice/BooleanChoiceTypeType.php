<?php

namespace Innova\ActivityBundle\Form\Type\ActivityType\Choice;

class BooleanChoiceTypeType extends AbstractChoiceTypeType
{
    public function getName()
    {
        return 'innova_activity_type_boolean';
    }

    public function getDefaultOptions()
    {
        return array (
            'data_class' => 'Innova\ActivityBundle\Entity\ActivityType\Choice\BooleanChoiceType',
        );
    }
}
