<?php

namespace Innova\ActivityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityType extends AbstractType
{
    // A faire pour les autres données ? information, objet, proposition, question ?

    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder->add('name', 'text', array('required' => true, 'max_length' => 20));
        $builder->add('description', 'text', array('required' => true));

/*
        $builder->add('information', 'text', array ('required' => true));
        $builder->add('object', 'text', array ('required' => true));
        $builder->add('proposition', 'text', array ('required' => true));
        $builder->add('question', 'text', array ('required' => true));
*/
    }

    public function getName()
    {
        return 'innova_activity';
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Innova\ActivityBundle\Entity\Activity',
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults($this->getDefaultOptions());

        return $this;
    }
}
