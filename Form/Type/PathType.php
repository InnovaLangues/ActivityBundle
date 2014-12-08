<?php

namespace Innova\ActivityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class AbstractPathType extends AbstractType
{
    abstract function getInstruction(); // Consigne
    // A faire pour les autres données : information, objet, proposition, question

    public function buildForm(FormBuilderInterface $builder, array $options = array ())
    {
        $builder->add('name', 'text', array ('required' => true));
        // A faire pour les autres données : information, objet, proposition, question
    }

    abstract function getDefaultOptions();

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults($this->getDefaultOptions());

        return $this;
    }
}