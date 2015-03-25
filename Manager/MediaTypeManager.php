<?php

namespace Innova\ActivityBundle\Manager;

use Innova\ActivityBundle\Entity\ActivityProperty\MediaTypeProperty;
use Innova\ActivityBundle\Entity\ActivityAnswer;
use Innova\ActivityBundle\Entity\Activity;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Media Type Manager
 * Performs CRUD actions for Media Type
 *
 * @DI\Service("innova.manager.mediatype_manager")
 */
class MediaTypeManager
{
    /**
    * @DI\InjectParams({
    *   "container" = @DI\Inject("service_container")
    * })
    */
    public function __construct($container)
    {
        $this->container = $container;
        $this->em = $this->container->get('claroline.persistence.object_manager');
    }

    public function get()
    {
        $list = $this->em->getRepository("InnovaActivityBundle:ActivityProperty\MediaTypeProperty")->findAll();
        
        return $list;
    }
   
}
