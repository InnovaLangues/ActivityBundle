<?php

namespace Innova\ActivityBundle\Entity\ActivityType;

use Doctrine\ORM\Mapping as ORM;

use Innova\ActivityBundle\Entity\Activity;

/**
 * Abstract Type
 * Base class for all Activity Types
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractType
{
    /**
     * Unique identifier of the Activity
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * General information about the Activity
     * @var \Innova\ActivityBundle\Entity\Activity
     *
     * @ORM\OneToOne(targetEntity="Innova\ActivityBundle\Entity\Activity")
     * @ORM\JoinColumn(name="activity_id", referencedColumnName="id")
     */
    protected $activity;

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Activity
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set Activity
     * @param \Innova\ActivityBundle\Entity\Activity $activity
     * @return AbstractType
     */
    public function setActivity(Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }
    
    /**
     * Define how to serialize our entity AbstractType
     * @return Array
     */
    public function jsonSerialize()
    {
        return array(
            'id'            => $this->id,
            'activity'      => $this->activity,
        );
    }
}