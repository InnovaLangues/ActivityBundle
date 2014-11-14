<?php

namespace Innova\ActivityBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Objet
 *
 * @ORM\Table("innova_objet")
 * @ORM\Entity
 */
class Objet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Title must not be empty")
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
    * @ORM\ManyToOne(targetEntity="activityQru", inversedBy="objets")
    * @ORM\ManyToOne(targetEntity="activityVf", inversedBy="objets")
    */
    protected $activity;


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
     * Set title
     *
     * @param string $title
     * @return Objet
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Set activity
     *
     * @param \Innova\ActivityBundle\Entity\activityQRU $activity
     * @return Objet
     */
    public function setActivity(\Innova\ActivityBundle\Entity\activityQRU $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \Innova\ActivityBundle\Entity\activityQRU
     */
    public function getActivity()
    {
        return $this->activity;
    }
}
