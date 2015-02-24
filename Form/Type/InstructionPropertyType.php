<?php

namespace Innova\ActivityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InstructionPropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder->add('media', 'text', array('required' => true));
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Innova\ActivityBundle\Entity\ActivityProperty\InstructionProperty',
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults($this->getDefaultOptions());

        return $this;
    }

    public function getName()
    {
        return 'innova_instruction';
    }
}
