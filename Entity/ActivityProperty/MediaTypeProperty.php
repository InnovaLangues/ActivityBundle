<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Proposition
 *
 * @ORM\Table("innova_activity_prop_media_type")
 * @ORM\Entity
 */
class MediaTypeProperty extends AbstractProperty implements \JsonSerializable
{
    /**
     * Unique identifier of the media type
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
    * Name of the media type
    * @var string
    *
    * @ORM\Column(name="name", type="text")
    */
    protected $name;
    
    /**
     * Description of the media type
     * @var boolean
     * 
     * @ORM\Column(name="description", type="text")
     */
    protected $description;
    
    /**
     * Name of the template file to load
     * @var string
     * 
     * @ORM\Column(name="template", type="text")
     */
    protected $template;
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }
    
    public function getTemplate()
    {
        return $this->template;
    }
    
    public function setTemplate($template)
    {
        $this->template = $template;
        
        return $this;
    }
    
    public function jsonSerialize()
    {
        return array(
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'template'      => $this->template,
        );
    }
}