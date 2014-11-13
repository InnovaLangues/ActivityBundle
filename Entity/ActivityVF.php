<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 13/11/2014 : Created.
 */

/**
 * @ORM\Table(name="innova_activityVf")
 * @ORM\Entity
 */
class ActivityVF extends Activity
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
    * @ORM\OneToMany(targetEntity="Question", mappedBy="activity", cascade={"remove"})
    */
    protected $questions;

    /**
    * @ORM\OneToMany(targetEntity="Objet", mappedBy="activity", cascade={"remove"})
    */
    protected $objets;

    /**
    * @ORM\OneToMany(targetEntity="Proposition", mappedBy="activity", cascade={"remove"})
    */
    protected $propositions;

    /**
    * @ORM\OneToMany(targetEntity="Consigne", mappedBy="activity", cascade={"remove"})
    */
    protected $consignes;

    /**
    * @ORM\OneToMany(targetEntity="Information", mappedBy="activity", cascade={"remove"})
    */
    protected $informations;

    /**
    * @ORM\ManyToOne(targetEntity="Claroline\CoreBundle\Entity\User")
    */
    protected $user;


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
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var integer
     */
    protected $order;

    /**
     * @var \Innova\ActivityBundle\Entity\ActivitySequence
     */
    protected $activitySequence;

    /**
     * @var \Claroline\CoreBundle\Entity\User
     */
    protected $author;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->objets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->propositions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->consignes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->informations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add questions
     *
     * @param \Innova\ActivityBundle\Entity\Question $questions
     * @return ActivityVF
     */
    public function addQuestion(\Innova\ActivityBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \Innova\ActivityBundle\Entity\Question $questions
     */
    public function removeQuestion(\Innova\ActivityBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Add objets
     *
     * @param \Innova\ActivityBundle\Entity\Objet $objets
     * @return ActivityVF
     */
    public function addObjet(\Innova\ActivityBundle\Entity\Objet $objets)
    {
        $this->objets[] = $objets;

        return $this;
    }

    /**
     * Remove objets
     *
     * @param \Innova\ActivityBundle\Entity\Objet $objets
     */
    public function removeObjet(\Innova\ActivityBundle\Entity\Objet $objets)
    {
        $this->objets->removeElement($objets);
    }

    /**
     * Get objets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObjets()
    {
        return $this->objets;
    }

    /**
     * Add propositions
     *
     * @param \Innova\ActivityBundle\Entity\Proposition $propositions
     * @return ActivityVF
     */
    public function addProposition(\Innova\ActivityBundle\Entity\Proposition $propositions)
    {
        $this->propositions[] = $propositions;

        return $this;
    }

    /**
     * Remove propositions
     *
     * @param \Innova\ActivityBundle\Entity\Proposition $propositions
     */
    public function removeProposition(\Innova\ActivityBundle\Entity\Proposition $propositions)
    {
        $this->propositions->removeElement($propositions);
    }

    /**
     * Get propositions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropositions()
    {
        return $this->propositions;
    }

    /**
     * Add consignes
     *
     * @param \Innova\ActivityBundle\Entity\Consigne $consignes
     * @return ActivityVF
     */
    public function addConsigne(\Innova\ActivityBundle\Entity\Consigne $consignes)
    {
        $this->consignes[] = $consignes;

        return $this;
    }

    /**
     * Remove consignes
     *
     * @param \Innova\ActivityBundle\Entity\Consigne $consignes
     */
    public function removeConsigne(\Innova\ActivityBundle\Entity\Consigne $consignes)
    {
        $this->consignes->removeElement($consignes);
    }

    /**
     * Get consignes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConsignes()
    {
        return $this->consignes;
    }

    /**
     * Add informations
     *
     * @param \Innova\ActivityBundle\Entity\Information $informations
     * @return ActivityVF
     */
    public function addInformation(\Innova\ActivityBundle\Entity\Information $informations)
    {
        $this->informations[] = $informations;

        return $this;
    }

    /**
     * Remove informations
     *
     * @param \Innova\ActivityBundle\Entity\Information $informations
     */
    public function removeInformation(\Innova\ActivityBundle\Entity\Information $informations)
    {
        $this->informations->removeElement($informations);
    }

    /**
     * Get informations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInformations()
    {
        return $this->informations;
    }

    /**
     * Set user
     *
     * @param \Claroline\CoreBundle\Entity\User $user
     * @return ActivityVF
     */
    public function setUser(\Claroline\CoreBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Claroline\CoreBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set author
     *
     * @param \Claroline\CoreBundle\Entity\User $author
     * @return ActivityVF
     */
    public function setAuthor(\Claroline\CoreBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Claroline\CoreBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
