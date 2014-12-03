<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityTypeAvailable
 * List all managed Activity types of the application
 * Attention : this table is populated by Doctrine fixtures
 *
 * @ORM\Entity
 * @ORM\Table("innova_activity_type_available")
 */
class ActivityTypeAvailable
{
    /**
     * Unique identifier of the Type
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Name of the type
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * Class of the Entity type
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=100)
     */
    protected $class;

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Set name
     * @param string $name
     * @return ActivityTypeAvailable
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get class
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set class
     * @param string $class
     * @return ActivityTypeAvailable
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }
}