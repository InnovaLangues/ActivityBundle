<?php

namespace Innova\ActivityBundle\Form\Type\ActivityType\Choice;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractChoiceTypeType extends AbstractType
{
    abstract public function getName();

    abstract public function getDefaultOptions();

    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder->add('choices', 'collection', array (
            'type'         => 'innova_activity_prop_choice',
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));
        $builder->add('randomlyOrdered', 'checkbox');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults($this->getDefaultOptions());

        return $this;
    }
}
