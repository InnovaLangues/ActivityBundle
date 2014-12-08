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

    public function create(Activity $activity)
    {
        $activityType = "ActivityQRU"; // For tests. Eric.
        var_dump($activityType);
        $activity = $this->add($activity, $activityType);

        return $activity;
    }

    public function add(Activity $activity, $activityType)
    {

        $activity = $this->em->factory('Innova\ActivityBundle\Entity\\' . $activityType);
        $activity->setName("New Activity");
        $activity->setDescription("New Description");
        /*$activity->setActivitySequence($activitySequence);*/
        $activity->setPosition(1);
        $this->em->persist($activity);
        $this->em->flush();

        return $activity;
    }

    public function delete(Activity $activity)
    {
        $this->em->remove($activity);
        $this->em->flush();

        $this->reorderActivity($activity);

        return $activity;
    }
}
