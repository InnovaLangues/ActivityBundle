<?php

namespace Innova\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array('constraints' => new NotBlank()));
        $builder->add('typeAvailable', 'entity', array(
                'class' => 'InnovaActivityBundle:ActivityAvailable\TypeAvailable',
                'property' => 'name',
            ));
    }

    public function getName()
    {
        return 'activity_form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'translation_domain' => 'resource'
            )
        );
    }
}