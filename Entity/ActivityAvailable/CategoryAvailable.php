<?php

namespace Innova\ActivityBundle\Entity\ActivityAvailable;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category available
 *
 * @ORM\Entity
 * @ORM\Table("innova_activity_available_category")
 */
class CategoryAvailable implements \JsonSerializable
{
    /**
     * Unique identifier of the Category
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Name of the Category
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * Icon of the Category
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=50)
     */
    protected $icon;

    /**
     * List of types
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="TypeAvailable", mappedBy="category", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $types;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

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
     * Get icon
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     *
     * @param string $icon
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Add a Type to the Category
     * @param TypeAvailable $type
     * @return $this
     */
    public function addType(TypeAvailable $type)
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setCategory($this);
        }

        return $this;
    }

    /**
     * Remove a Type from the Category
     * @param TypeAvailable $type
     * @return $this
     */
    public function removeType(TypeAvailable $type)
    {
        if ($this->types->contains($type)) {
            $this->types->removeElement($type);
            $type->setCategory(null);
        }

        return $this;
    }

    /**
     * Define how to serialize our entity CategoryAvailable
     * @return Array
     */
    public function jsonSerialize()
    {
        return array (
            'id'    => $this->id,
            'name'  => $this->name,
            'icon'  => $this->icon,
            'types' => $this->types->toArray(),
        );
    }
}