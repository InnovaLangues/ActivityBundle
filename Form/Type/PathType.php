<?php

namespace Innova\ActivityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class AbstractPathType extends AbstractType
{
    abstract function getInstruction(); // Consigne
    // A faire pour les autres données ? information, objet, proposition, question ?

    public function buildForm(FormBuilderInterface $builder, array $options = array ())
    {
        $builder->add('instruction', 'text', array ('required' => true));
        $builder->add('information', 'text', array ('required' => true));
        $builder->add('object', 'text', array ('required' => true));
        $builder->add('proposition', 'text', array ('required' => true));
        $builder->add('question', 'text', array ('required' => true));
    }

    abstract function getDefaultOptions();

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults($this->getDefaultOptions());

        return $this;
    }
}