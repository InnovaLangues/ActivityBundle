<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Instruction
 *
 * @ORM\Table("innova_activity_prop_instruction")
 * @ORM\Entity
 */
class InstructionProperty extends AbstractProperty implements \JsonSerializable
{
    /**
     * Unique identifier of the instruction
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Innova\ActivityBundle\Entity\Activity", inversedBy="instructionProperties")
     * @ORM\JoinColumn(name="id_activity", referencedColumnName="id")
     **/
    private $activity;
    
    /**
     * Define how to serialize our entity ActivitySequence
     * @return Array
     */
    public function jsonSerialize()
    {
        return array(
            'id'            => $this->id,
            'title'         => $this->title,
        );
    }
}