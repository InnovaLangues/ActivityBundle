<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Innova\ActivityBundle\Entity\ActivityAvailable\TypeAvailable;
use Innova\ActivityBundle\Entity\ActivityType\AbstractType;
use Innova\ActivityBundle\Entity\ActivityProperty\QuestionProperty;
use Innova\ActivityBundle\Entity\ActivityProperty\ComplementaryInfoProperty;
use Innova\ActivityBundle\Entity\ActivityProperty\InstructionProperty;
use Innova\ActivityBundle\Entity\ActivityProperty\ContentProperty;
use Innova\ActivityBundle\Entity\ActivityProperty\FunctionalInstructionProperty;
use Innova\ActivityBundle\Entity\ActivityProperty\MediaTypeProperty;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Activity
 * Stores common information about the Activity shared by all Activity Types
 *
 * @ORM\Entity
 * @ORM\Table("innova_activity")
 * @ORM\EntityListeners({ "Innova\ActivityBundle\Listener\ActivityListener" })
 */
class Activity implements \JsonSerializable
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
     * Name of the activity
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
     * @ORM\OneToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityProperty\QuestionProperty", mappedBy="activity", cascade={"persist","remove"})
     */
    protected $questions;

    /**
     * ActivityAvailable used to retrieve the correct ActivityType Entity when the Activity is loaded (using Doctrine Event Listener)
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Innova\ActivityBundle\Entity\ActivityAvailable\TypeAvailable")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $typeAvailable;
    
    /**
     * @ORM\ManyToOne(targetEntity="Innova\ActivityBundle\Entity\ActivityProperty\MediaTypeProperty")
     * @ORM\JoinColumn(name="media_type_id", referencedColumnName="id")
     **/
    protected $mediaType;
    /**
     * ActivityType (populated and persisted by Doctrine Event Listener)
     * @var \Innova\ActivityBundle\Entity\ActivityType\AbstractType
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityProperty\ComplementaryInfoProperty", mappedBy="activity", cascade={"persist","remove"})
     **/
    protected $complementaryInfos;

    /**
     * @ORM\OneToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityProperty\InstructionProperty", mappedBy="activity", cascade={"persist","remove"})
     **/
    protected $instructions;

    /**
     * @ORM\OneToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityProperty\ContentProperty", mappedBy="activity", cascade={"persist","remove"})
     **/
    protected $contents;
    
    /**
     * @ORM\OneToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityProperty\FunctionalInstructionProperty", mappedBy="activity", cascade={"persist","remove"})
     */
    protected $functionalInstructions;
    
    /**
     * Position of the Activity into the parent ActivitySequence
     * @var integer
     * @ORM\Column(name="activity_position", type="integer")
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
     *
     * @var integer
     * 
     * @ORM\Column(name="numTries", type="integer")
     */
    protected $numTries;
    
    /**
     * Parent ActivitySequence
     * @var \Innova\ActivityBundle\Entity\ActivitySequence
     * 
     * @ORM\ManyToOne(targetEntity="Innova\ActivityBundle\Entity\ActivitySequence", inversedBy="activities")
     * @ORM\JoinColumn(name="activity_sequence_id", referencedColumnName="id")
     */
    protected $activitySequence;
    
    public function __construct()
    {
        $this->complementaryInfos = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->instructions = new ArrayCollection();
        $this->contents = new ArrayCollection();
        $this->functionalInstructions = new ArrayCollection();
        $this->numTries = -1;
    }
    
    
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
     * @param  string                                 $name
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
     * @param string $description
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

    public function getTypeAvailable()
    {
        return $this->typeAvailable;
    }

    public function setTypeAvailable(TypeAvailable $typeAvailable)
    {
        $this->typeAvailable = $typeAvailable;

        return $this;
    }
    
    public function getMediaType()
    {
        return $this->mediaType;
    }
    
    public function setMediaType(MediaTypeProperty $mediaType)
    {
        $this->mediaType = $mediaType;
        
        return $this;
    }
    
    public function getQuestions()
    {
        return $this->questions;
    }
    
    public function setQuestions(ArrayCollection $questions)
    {
        foreach ($questions as $question) {
            $this->addQuestion($question);
        }
        
        return $this;
    }
    
    public function addQuestion(QuestionProperty $question)
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setActivity($this);
        }
        
        return $this;
    }
    
    public function addQuestions(ArrayCollection $questions)
    {
        foreach ($questions as $question) {
            if (!$this->questions->contains($question)) {
                $this->questions->add($question);
                $question->setActivity($this);
            }
        }
        
        return $this;
    }
    
    public function removeQuestion(QuestionProperty $question)
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            $question->setActivity(null);
        }
        
        return $this;
    }

    /**
     * Get type
     * @throws \LogicException
     * @return \Innova\ActivityBundle\Entity\ActivityType\AbstractType
     */
    public function getType()
    {
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
    
    public function getComplementaryInfos()
    {
        return $this->complementaryInfos;
    }
    
    public function setComplementaryInfos(ArrayCollection $complementaryInfos)
    {
        foreach ($complementaryInfos as $complementaryInfo) {
            $this->addComplementaryInfo($complementaryInfo);
        }
        
        return $this;
    }
    
    public function addComplementaryInfo(ComplementaryInfoProperty $complementaryInfo)
    {
        if (!$this->complementaryInfos->contains($complementaryInfo)) {
            $this->complementaryInfos->add($complementaryInfo);
            $complementaryInfo->setActivity($this);
        }
        
        return $this;
    }
    
    public function addComplementaryInfos(ArrayCollection $complementaryInfos)
    {
        foreach ($complementaryInfos as $complementaryInfo) {
            if (!$this->complementaryInfos->contains($complementaryInfo)) {
                $this->complementaryInfos->add($complementaryInfo);
                $complementaryInfo->setActivity($this);
            }
        }
        
        return $this;
    }
    
    public function removeComplementaryInfo(ComplementaryInfoProperty $complementaryInfo)
    {
        if ($this->complementaryInfos->contains($complementaryInfo)) {
            $this->complementaryInfos->removeElement($complementaryInfo);
            $complementaryInfo->setActivity(null);
        }
        
        return $this;
    }
    
    public function getInstructions()
    {
        return $this->instructions;
    }
    
    public function setInstructions(ArrayCollection $instructions)
    {
        foreach ($instructions as $instruction) {
            $this->addInstruction($instruction);
        }
        
        return $this;
    }
    
    public function addInstruction(InstructionProperty $instruction)
    {
        if (!$this->instructions->contains($instruction)) {
            $this->instructions->add($instruction);
            $instruction->setActivity($this);
        }
        
        return $this;
    }
    
    public function addInstructions(ArrayCollection $instructions)
    {
        foreach ($instructions as $instruction) {
            if (!$this->instructions->contains($instruction)) {
                $this->instructions->add($instruction);
                $instruction->setActivity($this);
            }
        }
        
        return $this;
    }
    
    public function removeInstruction(InstructionProperty $instruction)
    {
        if ($this->instructions->contains($instruction)) {
            $this->instructions->removeElement($instruction);
            $instruction->setActivity(null);
        }
        
        return $this;
    }
    
    public function getContents()
    {
        return $this->contents;
    }
    
    public function setContents(ArrayCollection $contents)
    {
        foreach ($contents as $content) {
            $this->addContent($content);
        }
        
        return $this;
    }
    
    public function addContent(ContentProperty $content)
    {
        if (!$this->contents->contains($content)) {
            $this->contents->add($content);
            $content->setActivity($this);
        }
        
        return $this;
    }
    
    public function addContents(ArrayCollection $contents)
    {
        foreach ($contents as $content) {
            if (!$this->contents->contains($content)) {
                $this->contents->add($content);
                $content->setActivity($this);
            }
        }
        
        return $this;
    }
    
    public function removeContent(ContentProperty $content)
    {
        if ($this->contents->contains($content)) {
            $this->contents->removeElement($content);
            $content->setActivity(null);
        }
        
        return $this;
    }
    
    public function getFunctionalInstructions()
    {
        return $this->functionalInstructions;
    }
    
    public function setFunctionalInstructions(ArrayCollection $functionalInstructions)
    {
        foreach ($functionalInstructions as $functionalInstruction) {
            $this->addFunctionalInstruction($functionalInstruction);
        }
        
        return $this;
    }
    
    public function addFunctionalInstruction(FunctionalInstructionProperty $functionalInstruction)
    {
        if (!$this->functionalInstructions->contains($functionalInstruction)) {
            $this->functionalInstructions->add($functionalInstruction);
            $functionalInstruction->setActivity($this);
        }
        
        return $this;
    }
    
    public function addFunctionalInstructions(ArrayCollection $functionalInstructions)
    {
        foreach ($functionalInstructions as $functionalInstruction) {
            if (!$this->functionalInstructions->contains($functionalInstruction)) {
                $this->functionalInstructions->add($functionalInstruction);
                $functionalInstruction->setActivity($this);
            }
        }
        
        return $this;
    }
    
    public function removeFunctionalInstruction(FunctionalInstructionProperty $functionalInstruction)
    {
        if ($this->functionalInstructions->contains($functionalInstruction)) {
            $this->functionalInstructions->removeElement($functionalInstruction);
            $functionalInstruction->setActivity(null);
        }
        
        return $this;
    }
    
    /**
     * 
     * @param integer $order
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
     * Set dateCreated
     * @param \Datetime
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function setDateCreated(\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
        
        return $this;
    }
    
    /**
     * Get dateCreated
     * @return \Datetime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
    
    /**
     * Set dateUpdated
     * @param \Datetime
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function setDateUpdated(\DateTime $dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
        
        return $this;
    }
    
    /**
     * Get dateUpdated
     * @return \Datetime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }
    
    
    public function setNumTries($numTries)
    {
        $this->numTries = $numTries;
        
        return $this;
    }
    
    public function getNumTries()
    {
        return $this->numTries;
    }
    
    /**
     * Set activitySequence
     * 
     * @internal Do not use, use ActivitySequence::addActivity() instead, to calculate position of the Activity in the Sequence
     * @param \Innova\ActivityBundle\Entity\ActivitySequence $activitySequence
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
     * Define how to serialize our entity Activity
     * @return Array
     */
    public function jsonSerialize()
    {
        
        return array(
            'id'            => $this->id,
            'name'          => $this->name,
            'typeAvailable' => $this->typeAvailable,
            'mediaType'     => $this->mediaType,
            'questions'     => $this->questions->toArray(),
            'description'   => $this->description,
            'complementaryInfos' => $this->complementaryInfos->toArray(),
            'instructions'  => $this->instructions->toArray(),
            'contents'      => $this->contents->toArray(),
            'functionalInstructions' => $this->functionalInstructions->toArray(),
            'type'          => $this->type,
            'position'      => $this->position,
            'dateCreated'   => $this->dateCreated,
            'dateUpdated'   => $this->dateUpdated,
            'numTries'      => $this->numTries,
            'activitySequenceId' => $this->activitySequence->getId(),
        );
    }
}
