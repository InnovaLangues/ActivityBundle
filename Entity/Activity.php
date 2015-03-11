<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Claroline\CoreBundle\Entity\Resource\AbstractResource;
use Innova\ActivityBundle\Entity\ActivityAvailable\TypeAvailable;
use Innova\ActivityBundle\Entity\ActivityType\AbstractType;
use Innova\ActivityBundle\Entity\ActivityProperty\InstructionProperty;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Activity
 * Stores common information about the Activity shared by all Activity Types
 *
 * @ORM\Entity
 * @ORM\Table("innova_activity")
 * @ORM\EntityListeners({ "Innova\ActivityBundle\Listener\ActivityListener" })
 */
class Activity extends AbstractResource implements \JsonSerializable
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
    * Description of the Activity
    * @var string
    *
    * @ORM\Column(name="description", type="text", nullable=true)
    */
    protected $description;
    
    /**
     * Question of the activity
     * @var string
     * 
     * @ORM\Column(name="question", type="text")
     */
    protected $question;

    /**
     * ActivityAvailable used to retrieve the correct ActivityType Entity when the Activity is loaded (using Doctrine Event Listener)
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Innova\ActivityBundle\Entity\ActivityAvailable\TypeAvailable")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $typeAvailable;

    /**
     * ActivityType (populated and persisted by Doctrine Event Listener)
     * @var \Innova\ActivityBundle\Entity\ActivityType\AbstractType
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityProperty\InstructionProperty", mappedBy="activity", cascade={"persist","remove"})
     **/
    protected $instructions;
    
    
    public function __construct()
    {
        $this->instructions = new ArrayCollection();
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
    
    /**
     * Get question
     */
    public function getQuestion()
    {
        return $this->question;
    }
    /**
     * @param string $question
     * @return \Innova\ActivityBundle\Entity\Activity
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        
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
        if (empty($this->type) || !($this->type instanceof AbstractType)) {
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
    
    /**
     * Define how to serialize our entity Activity
     * @return Array
     */
    public function jsonSerialize()
    {
        return array(
            'id'            => $this->id,
            'name'          => $this->resourceNode->getName(),
            'typeAvailable' => $this->typeAvailable,
            'question'      => $this->question,
            'description'   => $this->description,
            'instructions'  => $this->instructions->toArray(),
            'type'          => $this->type,
        );
    }
}
