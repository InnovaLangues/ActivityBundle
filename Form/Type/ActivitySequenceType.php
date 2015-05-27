<?php

namespace Innova\ActivityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ActivitySequenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    //    $builder->add('name', 'text', array('constraints' => new NotBlank()));
        $builder->add('name', 'text', array('required' => true));
        $builder->add('description', 'text', array ('required' => false));
        $builder->add('numTries');
        $builder->add('numAttempts');
    }
    
    public function getName()
    {
        return 'innova_activity_sequence';
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'translation_domain' => 'resource'
            )
        );
    }
}