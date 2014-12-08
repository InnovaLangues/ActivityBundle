<?php

namespace Innova\ActivityBundle\Manager;

use Innova\ActivityBundle\Entity\AbstractActivity;
use JMS\DiExtraBundle\Annotation as DI;
use Innova\ActivityBundle\Entity\Activity;

/**
 * @DI\Service("innova.manager.activity_manager")
 */
class ActivityManager
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

    public function create(Activity $activity){

        $activityType = "ActivityQRU"; // For tests. Eric.
        var_dump($activityType);
        $activity = $this->add($activity, $activityType);
//        $activity = $this->createActivity($activitySequence);

        return $activity;
    }

    public function add(Activity $activity, $activityType)
//    public function createActivity(ActivitySequence $activitySequence)
     {
//        $activityType = "ActivityVF";

        $activity = $this->em->factory('Innova\ActivityBundle\Entity\\' . $activityType);
//        $activity = new ActivityVF;
        $activity->setName("New Activity");
        $activity->setDescription("New Description");
        $activity->setActivitySequence($activitySequence);
        $activity->setPosition(1);
        $this->em->persist($activity);
        $this->em->flush();

        return $activity;
    }

    public function delete(AbstractActivity $activity) {
        $activity = $activity->getActivity();
        $this->em->remove($activity);
        $this->em->flush();

        $this->reorderActivity($activity);

        return $activity;
    }

    public function reorderActivity(Activity $activity){
        if ($activities = $activity->getActivities() ) {
            $i = 1;
            foreach ($activities as $activity) {
                $activity->setOrder($i);
                $this->em->persist($activity);
                $i++;
            }
            $this->em->flush();
        }
    }

    public function activityToJson(Activity $activity)
    {
        $activityActivities = array ();
        if ($activities = $activity->getActivities() ) {
            foreach ($activities as $activity) {
                $activityActivities[] = array (
                    "id" => $activity->getId(),
                    "name" => $activity->getName(),
                    "position" => $activity->getPosition()
                );
            }
        }

        $activityAttrs = array (
            "id"         => $activity->getId(),
            "name"       => $activity->getResourceNode()->getName(),
            "activities" => $activityActivities,
        );

        return json_encode($activityAttrs);
    }


    public function activityAttrs(AbstractActivity $activity)
    {
        $activityAttrs = array (
            "id" => $activity->getId(),
            "name" => $activity->getName(),
            "position" => $activity->getPosition()
        );

        return $activityAttrs;
    }

    public function applyOrder(ActivitySequence $activitySequence, $order)
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
