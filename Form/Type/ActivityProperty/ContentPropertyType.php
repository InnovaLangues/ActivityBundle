<?php

namespace Innova\ActivityBundle\Form\Type\ActivityProperty;

class ContentPropertyType extends AbstractPropertyType
{
    public function getDefaultOptions()
    {
        return array (
            'data_class' => 'Innova\ActivityBundle\Entity\ActivityProperty\ContentProperty',
        );
    }

    public function getName()
    {
        return 'innova_activity_prop_content';
    }
}
