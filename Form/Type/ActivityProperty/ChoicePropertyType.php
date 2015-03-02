<?php

namespace Innova\ActivityBundle\Form\Type\ActivityProperty;

class ChoicePropertyType extends AbstractPropertyType
{
    public function getDefaultOptions()
    {
        return array (
            'data_class' => 'Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty',
        );
    }

    public function getName()
    {
        return 'innova_activity_prop_choice';
    }
}
