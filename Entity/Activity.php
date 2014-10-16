<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Claroline\CoreBundle\Entity\Resource\AbstractResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="innova_activity")
 * @ORM\Entity
 */
class Activity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     *
     * @ORM\Column(name="activity_order", type="integer")
     */
    protected $order;

    /**
     * @ORM\ManyToOne(targetEntity="Innova\ActivityBundle\Entity\ActivitySequence", inversedBy="activities")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $activitySequence;

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
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
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
}
