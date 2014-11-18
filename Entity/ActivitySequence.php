<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Claroline\CoreBundle\Entity\Resource\AbstractResource;

/**
 * @ORM\Entity
 * @ORM\Table(name="innova_activitySequence")
 */
class ActivitySequence extends AbstractResource
{

    /**
    * @ORM\OneToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityQRU", mappedBy="activitySequence")
    * @ORM\OneToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityVF", mappedBy="activitySequence")
    */
    protected $activities;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add activities
     *
     * @param \Innova\ActivityBundle\Entity\Activity $activities
     * @return ActivitySequence
     */
    public function addActivity(\Innova\ActivityBundle\Entity\Activity $activities)
    {
        $this->activities[] = $activities;

        return $this;
    }

    /**
     * Remove activities
     *
     * @param \Innova\ActivityBundle\Entity\Activity $activities
     */
    public function removeActivity(\Innova\ActivityBundle\Entity\Activity $activities)
    {
        $this->activities->removeElement($activities);
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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}
