<?php

namespace Innova\ActivityBundle\Manager;

use Innova\ActivityBundle\Entity\ActivityAnswer;
use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Activity Manager
 * Performs CRUD actions for Activities
 *
 * @DI\Service("innova.manager.answer_manager")
 */
class ActivityAnswerManager
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

    public function create(Activity $activity, ChoiceProperty $choice)
    {
        //$choice = $this->em->getRepository("InnovaActivityBundle:ActivityProperty\ChoiceProperty")->find($choiceId);
                
        $activityAnswer = new ActivityAnswer();
        
        $security = $this->container->get("security.context");
        $activityAnswer->setUser($security->getToken()->getUser());
        $activityAnswer->setActivity($activity);
        $activityAnswer->addChoiceProperty($choice);
        $this->em->persist($activityAnswer);
        $this->em->flush();
        
        return $this;
    }
   
}
