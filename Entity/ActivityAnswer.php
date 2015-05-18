<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Claroline\CoreBundle\Entity\User;
use Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty;

/**
 * ActivityAnswer
 * Stores the answers the users gave to the Activity
 *
 * @ORM\Entity
 * @ORM\Table("innova_activity_answer")
 */
class ActivityAnswer implements \JsonSerializable
{
    /**
     * Unique identifier of the ActivityAnswer
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Claroline\CoreBundle\Entity\User")
     */
    protected $user;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Innova\ActivityBundle\Entity\Activity")
     */
    protected $activity;
    
    /**
     * 
     * @ORM\ManyToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty" )
     * @ORM\JoinTable(name="innova_activity_answer_choice",
     *      joinColumns={@ORM\JoinColumn(name="answer_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="choice_id", referencedColumnName="id")}
     *      )
     * 
     */
    protected $choiceProperties;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->choiceProperties = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    
    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    
    public function getActivity()
    {
        return $this->activity;
    }
    
    public function setActivity(Activity $activity)
    {
        $this->activity = $activity;
        
        return $this;
    }
    
    
    public function getAnswer()
    {
        return $this->answer;
    }
    
    public function setAnswer(ChoiceProperty $choiceProperty)
    {
        $this->answer = $choiceProperty;
        
        return $this;
    }

    /**
     * Add choiceProperties
     *
     * @param \Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty $choiceProperties
     * @return ActivityAnswer
     */
    public function addChoiceProperty(\Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty $choiceProperties)
    {
        $this->choiceProperties[] = $choiceProperties;

        return $this;
    }

    /**
     * Remove choiceProperties
     *
     * @param \Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty $choiceProperties
     */
    public function removeChoiceProperty(\Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty $choiceProperties)
    {
        $this->choiceProperties->removeElement($choiceProperties);
    }

    /**
     * Get choiceProperties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChoiceProperties()
    {
        return $this->choiceProperties;
    }
    
    /**
     * Define how to serialize our entity ActivityAnswer
     * @return Array
     */
    public function jsonSerialize()
    {
        
        return array(
            'id'                => $this->id,
            'user'              => $this->user,
            'activity'          => $this->activity,
            'choiceProperties'  => $this->choiceProperties->toArray(),
        );
    }
}
