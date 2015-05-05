<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Symfony\Component\Validator\Constraints as Assert;
use Innova\ActivityBundle\Entity\Activity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table("innova_activity_prop_question")
 * @ORM\Entity
 */
class QuestionProperty extends AbstractProperty implements \JsonSerializable
{
    /**
     * Unique identifier of the question
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Innova\ActivityBundle\Entity\Activity", inversedBy="questions")
     * @ORM\JoinColumn(name="activity_id", referencedColumnName="id")
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
     *
     * Position of the instruction in the list
     * @var integer
     * 
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;
    
    /**
     * Define how to serialize our entity Activity
     * @return Array
     */
    public function jsonSerialize()
    {
        return array(
            'id'            => $this->id,
            'media'         => $this->media,
            'position'      => $this->position
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
    
    public function getMedia()
    {
        return $this->media;
    }
    
    public function setMedia($media)
    {
        $this->media = $media;
        
        return $this;
    }
    
    public function getPosition()
    {
        return $this->position;
    }
    
    public function setPosition($position)
    {
        $this->position = $position;
        
        return $this;
    }
    
}