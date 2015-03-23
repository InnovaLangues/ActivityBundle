<?php

namespace Innova\ActivityBundle\Form\Type\ActivityProperty;

class MediaTypePropertyType extends AbstractPropertyType
{
    public function getDefaultOptions()
    {
        return array (
            'data_class' => 'Innova\ActivityBundle\Entity\ActivityProperty\MediaTypeProperty',
        );
    }

    public function getName()
    {
        return 'innova_activity_prop_media_type';
    }
}
