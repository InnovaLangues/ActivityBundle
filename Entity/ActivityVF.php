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
    private $id;

    /**
    * @ORM\OneToMany(targetEntity="Question", mappedBy="activity", cascade={"remove"})
    */
    protected $questions;

    /**
    * @ORM\OneToMany(targetEntity="Object", mappedBy="activity", cascade={"remove"})
    */
    protected $objects;

    /**
    * @ORM\OneToMany(targetEntity="Proposition", mappedBy="activity", cascade={"remove"})
    */

    protected $propositions;

    /**
    * @ORM\OneToMany(targetEntity="Instruction", mappedBy="activity", cascade={"remove"})
    */
    protected $instructions;

    /**
    * @ORM\OneToMany(targetEntity="Information", mappedBy="activity", cascade={"remove"})
    */
    protected $informations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->objects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->propositions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->instructions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->informations = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add objects
     *
     * @param \Innova\ActivityBundle\Entity\Object $objects
     * @return ActivityVF
     */
    public function addObject(\Innova\ActivityBundle\Entity\Object $objects)
    {
        $this->objects[] = $objects;

        return $this;
    }

    /**
     * Remove objects
     *
     * @param \Innova\ActivityBundle\Entity\Object $objects
     */
    public function removeObject(\Innova\ActivityBundle\Entity\Object $objects)
    {
        $this->objects->removeElement($objects);
    }

    /**
     * Get objects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObjects()
    {
        return $this->objects;
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
     * Add instructions
     *
     * @param \Innova\ActivityBundle\Entity\Instruction $instructions
     * @return ActivityVF
     */
    public function addInstruction(\Innova\ActivityBundle\Entity\Instruction $instructions)
    {
        $this->instructions[] = $instructions;

        return $this;
    }

    /**
     * Remove instructions
     *
     * @param \Innova\ActivityBundle\Entity\Instruction $instructions
     */
    public function removeInstruction(\Innova\ActivityBundle\Entity\Instruction $instructions)
    {
        $this->instructions->removeElement($instructions);
    }

    /**
     * Get instructions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInstructions()
    {
        return $this->instructions;
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

}
