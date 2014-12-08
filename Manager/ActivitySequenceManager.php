<?php

namespace Innova\ActivityBundle\Manager;

use JMS\DiExtraBundle\Annotation as DI;

use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;

/**
 * @DI\Service("innova.manager.activity_sequence_manager")
 */
class ActivitySequenceManager
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

    public function addActivity(ActivitySequence $activitySequence){

        $activityType = "ActivityQRU"; // For tests. Eric.
        $activity = $this->createActivity($activitySequence, $activityType);

        return $activity;
    }

    public function createActivity(ActivitySequence $activitySequence, $activityType)
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

    public function removeActivity(Activity $activity) {
        $activitySequence = $activity->getActivitySequence();
        $this->em->remove($activity);
        $this->em->flush();

        return $activitySequence;
    }
}
