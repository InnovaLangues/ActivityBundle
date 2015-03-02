<?php

namespace Innova\ActivityBundle\Entity\ActivityType\Choice;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Innova\ActivityBundle\Entity\ActivityType\AbstractType;
use Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty;

/**
 * Abstract Choice type
 * Base class for all Activities with choices
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractChoiceType extends AbstractType implements \JsonSerializable
{
    /**
     * Get all choices
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    abstract function getChoices();

    /**
     * Set all choices
     */
    abstract function setChoices(ArrayCollection $choices);
    
    /**
     * Add a choice to the list of choices
     * @param  \Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty $choice
     * @return \Innova\ActivityBundle\Entity\ActivityType\AbstractChoiceType
     */
    abstract function addChoice(ChoiceProperty $choice);

    /**
     * Remove a choice from the list of choices
     * @param  \Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty $choice
     * @return \Innova\ActivityBundle\Entity\ActivityType\AbstractChoiceType
     */
    abstract function removeChoice(ChoiceProperty $choice);
}