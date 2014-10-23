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
            $count = 1;
        }

        return count($count) + 1;
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
        $activitySequence = $activity->getActivitySequence();
        $this->em->remove($activity);
        $this->em->flush();

        $this->reorderActivitySequence($activitySequence);

        return $activitySequence;
    }

    function reorderActivitySequence(ActivitySequence $activitySequence){
        if ($activities = $activitySequence->getActivities() ) {
            $i = 1;
            foreach ($activities as $activity) {
                $activity->setOrder($i);
                $this->em->persist($activity);
                $i++;
            }
            $this->em->flush(); 
        }
    }

    function activitySequenceToJson(ActivitySequence $activitySequence)
    {
        $activitySequenceActivities = array ();
        if ($activities = $activitySequence->getActivities() ) {
            foreach ($activities as $activity) {
                $activitySequenceActivities[] = array (
                                                                    "id" => $activity->getId(),
                                                                    "name" => $activity->getName(),
                                                                    "order" => $activity->getOrder()
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
                            "order" => $activity->getOrder()
        );

        return $activityAttrs;
    }

    function applyOrder(ActivitySequence $activitySequence, $order)
    {
        $i=1;
        $order = json_decode($order);
        foreach ($order as $activityId) {
            $activity = $this->em->getRepository('InnovaActivityBundle:Activity')->find($activityId);
            $activity->setOrder($i);
            $this->em->persist($activity);
            $i++;
        }
        $this->em->flush();

        return $activitySequence;
    }
}
