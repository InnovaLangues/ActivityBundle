<?php

namespace Innova\ActivityBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Consigne
 *
 * @ORM\Table("innova_consigne")
 * @ORM\Entity
 */
class Consigne
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
    * @ORM\ManyToOne(targetEntity="activityQRU", inversedBy="consignes")
    * @ORM\ManyToOne(targetEntity="activityVF", inversedBy="consignes")
    */
    protected $activity;

    /**
     * @var integer
     *
     * @ORM\Column(name="consigneType", type="integer")
     */
    private $consigneType;


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
     * @return Consigne
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
     * Set consigneType
     *
     * @param integer $consigneType
     * @return Consigne
     */
    public function setConsigneType($consigneType)
    {
        $this->consigneType = $consigneType;

        return $this;
    }

    /**
     * Get consigneType
     *
     * @return integer
     */
    public function getConsigneType()
    {
        return $this->consigneType;
    }

    /**
     * Set activity
     *
     * @param \Innova\ActivityBundle\Entity\activityQRU $activity
     * @return Consigne
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
