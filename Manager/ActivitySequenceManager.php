<?php

namespace Innova\ActivityBundle\Manager;

use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("innova.manager.activity_sequence_manager")
 */
class ActivitySequenceManager
{
    /**
    * @DI\InjectParams({
    *   "container" = @DI\Inject("service_container"),
    *   "em" = @DI\Inject("doctrine.orm.entity_manager"),
    * })
    */
    public function __construct($container, $em)
    {
        $this->container = $container;
        $this->em = $em;
    }

    function countActivities(ActivitySequence $activitySequence){
        if(!$count = $activitySequence->getActivities()){
            $count = 0;
        }

        return count($count);
    }

    function addActivity(ActivitySequence $activitySequence){
        $activity = $this->createActivity($activitySequence);

        return $activitySequence;
    }

     function createActivity(ActivitySequence $activitySequence){
        $activity = new Activity;
        $activity->setName("");
        $activity->setDescription("");
        $activity->setActivitySequence($activitySequence);
        $activity->setOrder($this->countActivities($activitySequence));
        $this->em->persist($activity);
        $this->em->flush();

        return $activity;
    }
}
