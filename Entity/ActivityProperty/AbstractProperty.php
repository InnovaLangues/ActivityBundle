<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Abstract Property
 * Base class for all Activity property object
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractProperty
{
    /**
     * Unique identifier of the choice
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Title must not be empty")
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return AbstractProperty
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}