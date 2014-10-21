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

        return $activity;
    }

     function createActivity(ActivitySequence $activitySequence)
     {
        $activity = new Activity;
        $activity->setName("New Activity");
        $activity->setDescription("");
        $activity->setActivitySequence($activitySequence);
        $activity->setOrder($this->countActivities($activitySequence));
        $this->em->persist($activity);
        $this->em->flush();

        return $activity;
    }

    function deleteActivity(Activity $activity) {
        $this->em->remove($activity);
        $this->em->flush();

        return $this;
    }

    function activitySequenceToJson(ActivitySequence $activitySequence)
    {
        $activitySequenceActivities = array ();
        if ($activities = $activitySequence->getActivities() ) {
            foreach ($activities as $activity) {
                $activitySequenceActivities[] = array (
                                                                    "id" => $activity->getId(),
                                                                    "name" => $activity->getName(),
                );
            }
        }

        $activitySequenceAttrs = array (
            "id"            => $activitySequence->getId(),
            "name"      => $activitySequence->getResourceNode()->getName(),
            "activities" => $activitySequenceActivities,
        );

        return json_encode($activitySequenceAttrs);
    }


    function activityAttrs(Activity $activity)
    {
        $activityAttrs = array (
                            "id" => $activity->getId(),
                            "name" => $activity->getName(),
        );

        return $activityAttrs;
    }
}
