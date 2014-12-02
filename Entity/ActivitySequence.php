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
class ActivitySequence extends AbstractResource
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
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="activitySequence")
     */
    protected $activities;

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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
            $this->activities->add($activity);

            // Update Activity relationship
            $activity->setActivitySequence($this);
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
}
