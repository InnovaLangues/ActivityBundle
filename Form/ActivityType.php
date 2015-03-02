<?php

namespace Innova\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array ('required' => true));
        $builder->add('description', 'text', array ('required' => false));
        $builder->add('typeAvailable', 'entity', array (
            'class' => 'InnovaActivityBundle:ActivityAvailable\TypeAvailable',
            'property' => 'name',
        ));
    }

    public function getName()
    {
        return 'activity_form';
    }

    public function getDefaultOptions()
    {
        return array (
            'data_class' => 'Innova\ActivityBundle\Entity\Activity',
            'translation_domain' => 'resource',
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults($this->getDefaultOptions());

        return $this;
    }
}