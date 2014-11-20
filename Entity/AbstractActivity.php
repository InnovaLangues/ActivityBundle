<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * 13/11/2014 : updating to abstract class and all columns.
 * 19/11/2014 : add SortablePosition on order column.
 */

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractActivity
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * Order of the steps relative to his siblings in the path
     * @var integer
     * @ORM\Column(name="activity_order", type="integer")
     * @Gedmo\SortablePosition
     */
    protected $position;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedDate", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedDate;

    /**
     * Set name
     *
     * @param string $name
     * @return Activity
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Activity
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
     * Set order
     *
     * @param integer $order
     * @return Activity
     */
    public function setPosition($order)
    {
        $this->position = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set activitySequence
     *
     * @param \Innova\ActivityBundle\Entity\ActivitySequence $activitySequence
     * @return Activity
     */
    public function setActivitySequence(\Innova\ActivityBundle\Entity\ActivitySequence $activitySequence = null)
    {
        $this->activitySequence = $activitySequence;

        return $this;
    }

    /**
     * Get activitySequence
     *
     * @return \Innova\ActivityBundle\Entity\ActivitySequence
     */
    public function getActivitySequence()
    {
        return $this->activitySequence;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return Activity
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     * @return Activity
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }
}
