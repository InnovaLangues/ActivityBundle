<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Innova\ActivityBundle\Entity\ActivityType\AbstractType;

/**
 * Activity
 * Stores common information about the Activity shared by all Activity Types
 *
 * @ORM\Entity
 * @ORM\Table("innova_activity")
 * @ORM\EntityListeners({ "Innova\ActivityBundle\Listener\ActivityListener" })
 */
class Activity
{
    /**
     * Unique identifier of the Activity
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Name of the Activity
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * Description of the Activity
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * Position of the Activity into the parent ActivitySequence
     * @var integer
     * @ORM\Column(name="activity_position", type="integer")
     * @Gedmo\SortablePosition
     */
    protected $position;

    /**
     * Creation date of the Activity
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $dateCreated;

    /**
     * Updated date of the Activity
     * @var \DateTime
     *
     * @ORM\Column(name="date_updated", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $dateUpdated;

    /**
     * ActivityTypeAvailable used to retrieve the correct ActivityType Entity when the Activity is loaded (using Doctrine Event Listener)
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityTypeAvailable")
     * @ORM\JoinTable(name="innova_activity_type_available_activity",
     *      joinColumns        = { @ORM\JoinColumn(name="activity_id", referencedColumnName="id") },
     *      inverseJoinColumns = { @ORM\JoinColumn(name="type_id",     referencedColumnName="id", unique=true) }
     * )
     */
    protected $typeAvailable;

    /**
     * ActivityType (populated and persisted by Doctrine Event Listener)
     * @var \Innova\ActivityBundle\Entity\ActivityType\AbstractType
     */
    protected $type;

    /**
     * Parent ActivitySequence
     * @var \Innova\ActivityBundle\Entity\ActivitySequence
     *
     * @ORM\ManyToOne(targetEntity="Innova\ActivityBundle\Entity\ActivitySequence", inversedBy="activities")
     * @ORM\JoinColumn(name="activity_sequence_id", referencedColumnName="id")
     */
    protected $activitySequence;

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     * @param string $name
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     * @param  string $description
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set order
     * @param  integer $order
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function setPosition($order)
    {
        $this->position = $order;

        return $this;
    }

    /**
     * Get order
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set activitySequence
     * @internal
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence $activitySequence
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function setActivitySequence(ActivitySequence $activitySequence = null)
    {
        $this->activitySequence = $activitySequence;

        return $this;
    }

    /**
     * Get activitySequence
     * @return \Innova\ActivityBundle\Entity\ActivitySequence
     */
    public function getActivitySequence()
    {
        return $this->activitySequence;
    }

    /**
     * Set dateCreated
     * @param  \DateTime $dateCreated
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function setDateCreated(\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     * @param \DateTime $dateUpdated
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function setDateUpdated(\DateTime $dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    public function getTypeAvailable()
    {
        return $this->typeAvailable;
    }

    public function setTypeAvailable(ActivityTypeAvailable $typeAvailable)
    {
        $this->typeAvailable = $typeAvailable;

        return $this;
    }

    /**
     * Get type
     * @throws \LogicException
     * @return \Innova\ActivityBundle\Entity\ActivityType\AbstractType
     */
    public function getType()
    {
        // throw an exception if type hasn't been loaded
        if (empty($this->type) || !($this->type instanceof AbstractType) ) {
            throw new \LogicException('ActivityType has not been correctly loaded.');
        }

        return $this->type;
    }

    /**
     * Set type
     * @param  \Innova\ActivityBundle\Entity\ActivityType\AbstractType $type
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function setType(AbstractType $type)
    {
        $this->type = $type;

        return $this;
    }
}
