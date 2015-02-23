<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Claroline\CoreBundle\Entity\Resource\AbstractResource;
use Innova\ActivityBundle\Entity\ActivityAvailable\TypeAvailable;
use Innova\ActivityBundle\Entity\ActivityType\AbstractType;


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

    // ...
    /**
     * @ORM\OneToMany(targetEntity="Innova\ActivityBundle\Entity\ActivityProperty\InstructionProperty", mappedBy="activity")
     **/
    protected $instructionProperty;
    
    
    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
    
    
    public function getInstructionProperty() {
        return $this->instructionProperty;
    }

    
    public function setInstructionProperty(InstructionProperty $instructionProperty) {
        $this->instructionProperty = $instructionProperty;
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
            'description'   => $this->description,
            'instructions'  => array(
                array('id' => 1, 'title' => "titre1"),
                array('id' => 2, 'title' => "titre2"),
                array('id' => 3, 'title' => "titre3"),
                ),
        );
    }
}
