<?php

namespace Innova\ActivityBundle\Entity\ActivityType\Choice;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty;

/**
 * Unique Choice type
 * An activity where the response is a unique choice into a list of possible responses
 *
 * @ORM\Table(name="innova_activity_type_unique")
 * @ORM\Entity
 */
class UniqueChoiceType extends AbstractChoiceType implements \JsonSerializable
{
    /**
     * Unique identifier of the type
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * List of choices of the Activity
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty", cascade={"persist"})
     * @ORM\JoinTable(
     *      name               = "innova_activity_type_unique_choices",
     *      joinColumns        = { @ORM\JoinColumn(name="type_id",   referencedColumnName="id") },
     *      inverseJoinColumns = { @ORM\JoinColumn(name="choice_id", referencedColumnName="id", unique=true) }
     * )
     */
    protected $choices;
    
    /**
     * The order of the choices is random or not
     * @var boolean
     * 
     * @ORM\Column(name="randomlyOrdered", type="boolean")
     */
    protected $randomlyOrdered;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->choices = new ArrayCollection();
        $choice1 = new ChoiceProperty();
        $choice1->setMedia("");
        $choice1->setCorrectAnswer("correct");
        $choice1->setPosition(0);
        $this->addChoice($choice1);
        $choice2 = new ChoiceProperty();
        $choice2->setMedia("");
        $choice2->setCorrectAnswer("wrong");
        $choice2->setPosition(1);
        $this->addChoice($choice2);
        $this->randomlyOrdered = 0;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get all choices
     * @return ArrayCollection
     */
    public function getChoices()
    {
        return $this->choices;
    }
    
    /**
     * 
     * @param ArrayCollection $choices
     * @return \Innova\ActivityBundle\Entity\ActivityType\UniqueChoiceType
     */
    public function setChoices(ArrayCollection $choices)
    {
        foreach ($choices as $choice) {
            $this->addChoice($choice);
        }
        
        return $this;
    }

    /**
     * Add a choice to the list of choices
     * @param ChoiceProperty $choice
     * @return AbstractChoiceType
     */
    public function addChoice(ChoiceProperty $choice)
    {
        if (!$this->choices->contains($choice)) {
            $this->choices->add($choice);
        }

        return $this;
    }

    /**
     * Remove a choice from the list of choices
     * @param ChoiceProperty $choice
     * @return AbstractChoiceType
     */
    public function removeChoice(ChoiceProperty $choice)
    {
        if ($this->choices->contains($choice)) {
            $this->choices->removeElement($choice);
        }

        return $this;
    }
    
    /**
     * Get if the choices are randomly ordered or not
     * @return Boolean
     */
    public function isRandomlyOrdered()
    {
        return $this->randomlyOrdered;
    }
    
    /**
     * Tell if the choices are randomly ordered or not
     * @return AbstractChoiceType
     */
    public function setRandomlyOrdered($randomlyOrdered)
    {
        $this->randomlyOrdered = $randomlyOrdered;
        
        return $this;
    }
    
    /**
     * Define how to serialize our entity UniqueChoiceType
     * @return Array
     */
    public function jsonSerialize()
    {
        return array(
            'id'            => $this->id,
            'choices'       => $this->choices->toArray(),
            'randomlyOrdered'   => $this->randomlyOrdered,
        );
    }
}
