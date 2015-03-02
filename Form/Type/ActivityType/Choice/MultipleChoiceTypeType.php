<?php

namespace Innova\ActivityBundle\Form\Type\ActivityType\Choice;

class MultipleChoiceTypeType extends AbstractChoiceTypeType
{
    public function getName()
    {
        return 'innova_activity_type_multiple';
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Innova\ActivityBundle\Entity\ActivityType\Choice\MultipleChoiceType',
        );
    }
}
