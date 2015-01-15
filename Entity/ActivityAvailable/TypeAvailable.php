<?php

namespace Innova\ActivityBundle\Entity\ActivityAvailable;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Type available
 *
 * @ORM\Entity
 * @ORM\Table("innova_activity_available_type")
 */
class TypeAvailable implements \JsonSerializable
{
    /**
     * Unique identifier of the Type
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Name of the Type
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * Class of the Entity type
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=100)
     * @Assert\NotBlank
     */
    protected $class;

    /**
     * Category of the Type
     * @var CategoryAvailable
     *
     * @ORM\ManyToOne(targetEntity="CategoryAvailable", inversedBy="types")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     **/
    protected $category;

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
     * @return $this
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
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get category
     * @return CategoryAvailable
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     * @param CategoryAvailable $category
     * @return $this
     */
    public function setCategory(CategoryAvailable $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Define how to serialize our entity TypeAvailable
     * @return Array
     */
    public function jsonSerialize()
    {
        return array (
            'id'    => $this->id,
            'name'  => $this->name,
            'class' => $this->class,
        );
    }
}