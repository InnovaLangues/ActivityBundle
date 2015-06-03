<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Doctrine\ORM\Mapping as ORM;
use Claroline\CoreBundle\Entity\Resource\ResourceNode;

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
     * Resource associated with the choice (audio / photo / video)
     * @var ResourceNode
     * @ORM\ManyToOne(targetEntity="Claroline\CoreBundle\Entity\Resource\ResourceNode")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id", nullable=true)
     */
    protected $resource;
    
    
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
    
    public function setResource(ResourceNode $resource = null){
        $this->resource = $resource;
        return $this;
    }
    
    public function getResource(){
        return $this->resource;
    }
    
    public function jsonSerialize()
    {
        return array(
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'resource'      => $this->resource ? $this->resource->getId() : null
        );
    }
}