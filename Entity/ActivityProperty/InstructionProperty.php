<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Symfony\Component\Validator\Constraints as Assert;
use Innova\ActivityBundle\Entity\Activity;
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
     * @ORM\ManyToOne(targetEntity="Innova\ActivityBundle\Entity\Activity", inversedBy="instructions")
     * @ORM\JoinColumn(name="id_activity", referencedColumnName="id")
     **/
    private $activity;
    
    /**
    * Media UUID
    * @var string
    *
    * @ORM\Column(name="media", type="text")
    */
    protected $media;
    
    /**
     * Define how to serialize our entity Activity
     * @return Array
     */
    public function jsonSerialize()
    {
        return array(
            'id'            => $this->id,
            'title'         => $this->title,
            'media'         => $this->media
        );
    }
    
    public function getActivity() 
    {
        return $this->activity;
    }
    
    public function setActivity(Activity $activity = null) 
    {
        $this->activity = $activity;
        
        return $this;
    }
    
}