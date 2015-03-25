<?php

namespace Innova\ActivityBundle\Form\Type\ActivityProperty;

use Symfony\Component\Form\FormBuilderInterface;

class ChoicePropertyType extends AbstractPropertyType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('correctAnswer', 'checkbox', array ('required' => true));
        $builder->add('position');
        $builder->add('mediaType', 'entity', array(
            'class' => 'InnovaActivityBundle:ActivityProperty\MediaTypeProperty',
            'property' => 'name',
        ));
    }
    
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
