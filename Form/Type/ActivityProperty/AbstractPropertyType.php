<?php

namespace Innova\ActivityBundle\Form\Type\ActivityProperty;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class AbstractPropertyType extends AbstractType
{
    abstract public function getName();

    abstract public function getDefaultOptions();

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('media', 'text', array ('required' => true));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults($this->getDefaultOptions());

        return $this;
    }
}
