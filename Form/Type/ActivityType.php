<?php

namespace Innova\ActivityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder->add('name',        'text', array ('required' => true));
        $builder->add('description', 'text', array ('required' => false));

        $builder->add('mediaType', 'entity', array(
            'class' => 'InnovaActivityBundle:ActivityProperty\MediaTypeProperty',
            'property' => 'name',
        ));
        $builder->add('question', 'text', array ('required' => true));
        $builder->add('contents', 'collection', array(
            'type'         => 'innova_activity_prop_content',
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));
        $builder->add('instructions', 'collection', array (
            'type'         => 'innova_activity_prop_instruction',
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));
        $builder->add('functionalInstructions', 'collection', array (
            'type'         => 'innova_activity_prop_functional_instruction',
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));

        // Get and add the specific form for the current ActivityType
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event){
            $activity = $event->getData();
            $form = $event->getForm();

            $type = $activity->getTypeAvailable();
            if (!empty($type)) {
                // Add the form corresponding to this type
                $form->add('type', $type->getForm());
            }
        });
    }

    public function getName()
    {
        return 'innova_activity';
    }

    public function getDefaultOptions()
    {
        return array (
            'data_class' => 'Innova\ActivityBundle\Entity\Activity',
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults($this->getDefaultOptions());

        return $this;
    }
}
