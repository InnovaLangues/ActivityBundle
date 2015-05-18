<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Innova\ActivityBundle\Entity\ActivityProperty\MediaTypeProperty;

/**
 * Proposition
 *
 * @ORM\Table("innova_activity_prop_choice")
 * @ORM\Entity
 */
class ChoiceProperty extends AbstractProperty implements \JsonSerializable
{
    /**
     * Unique identifier of the choice
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
    * Media UUID
    * @var string
    *
    * @ORM\Column(name="media", type="text")
    */
    protected $media;
    
    /**
     * Answer is correct or wrong
     * @var string
     * 
     * @ORM\Column(name="correct_answer", type="text")
     */
    protected $correctAnswer;
    
    /**
     *
     * Position of the choice in the list
     * @var integer
     * 
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;
    
    public function getid()
    {
        return $this->id;
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
    
    public function isCorrectAnswer()
    {
        return $this->correctAnswer;
    }
    
    public function setCorrectAnswer($correctAnswer)
    {
        $this->correctAnswer = $correctAnswer;
        
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
    
    public function jsonSerialize()
    {
        return array(
            'id'            => $this->id,
            'media'         => $this->media,
            'correctAnswer' => $this->correctAnswer,
            'position'      => $this->position,
        );
    }
}