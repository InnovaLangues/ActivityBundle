<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Claroline\CoreBundle\Entity\Resource\AbstractResource;

/**
 * ActivitySequence
 * Aggregates Activities together
 *
 * @ORM\Entity
 * @ORM\Table(name="innova_activity_sequence")
 */
class ActivitySequence extends AbstractResource implements \JsonSerializable
{
    /**
     * Unique identifier of the Sequence
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Description of the Sequence
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * List of all Activities of the Sequence
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="activitySequence", cascade={ "persist", "remove" })
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $activities;
    
    /**
     *
     * @var integer
     * 
     * @ORM\Column(name="numAttempts", type="integer")
     */
    protected $numAttempts;
    
    /**
     *
     * @var integer
     * 
     * @ORM\Column(name="numTries", type="integer")
     */
    protected $numTries;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activities = new ArrayCollection();
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
     * Set description
     *
     * @param string $description
     * @return ActivitySequence
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return stringprotected
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    
    /**
     * @param integer $numAttempts
     * @return ActivitySequence
     */
    public function setNumAttempts($numAttempts)
    {
        $this->numAttempts = $numAttempts;
    }
    
    /**
     * 
     * @return integer
     */
    public function getNumAttempts()
    {
        return $this->numAttempts;
    }
    
    /**
     * 
     * @param integer $numTries
     * @return ActivitySequence
     */
    public function setNumTries($numTries)
    {
        $this->numTries = $numTries;
        
        return $this;
    }
    
    /**
     * 
     * @return integer
     */
    public function getNumTries()
    {
        return $this->numTries;
    }

    /**
     * Add activity
     *
     * @param \Innova\ActivityBundle\Entity\Activity $activity
     * @return ActivitySequence
     */
    public function addActivity(Activity $activity)
    {
        if (!$this->activities->contains($activity)) {
            // Retrieve current position of the Activity
            $activityPosition = count($this->activities) + 1;

            // Add Activity to Activities list
            $this->activities->add($activity);

            // Update Activity relationship
            $activity->setActivitySequence($this);

            // Update position of the Activity into the sequence
            $activity->setPosition($activityPosition);
        }

        return $this;
    }

    /**
     * Remove activity
     *
     * @param \Innova\ActivityBundle\Entity\Activity $activity
     * @return ActivitySequence
     */
    public function removeActivity(Activity $activity)
    {
        if ($this->activities->contains($activity)) {
            $this->activities->removeElement($activity);

            // Update Activity relationship
            $activity->setActivitySequence(null);

            // Update Activities position
            $position = 1;
            foreach ($this->activities as $activity) {
                $activity->setPosition($position);

                $position++;
            }
        }

        return $this;
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Define how to serialize our entity ActivitySequence
     * @return Array
     */
    public function jsonSerialize()
    {
        return array (
            'id'         => $this->id,
            'description'=> $this->description,
            'name'       => $this->resourceNode->getName(),
            'activities' => $this->activities->toArray(),
            'numTries'   => $this->numTries,
            'numAttempts' => $this->numAttempts,
        );
    }
}
