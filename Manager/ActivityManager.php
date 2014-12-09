<?php

namespace Innova\ActivityBundle\Manager;

use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Entity\ActivitySequence;
use JMS\DiExtraBundle\Annotation as DI;

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

    public function create(ActivitySequence $activitySequence)
    {
        // Gérer les types d'activité plus tard
        $activityType = "UniqueChoiceType"; // For tests. Eric.

        /*$activity = $this->em->factory('Innova\ActivityBundle\Entity\ActivityType\\' . $activityType);*/

        $activity = new Activity();
        $activity->setName("New Activity");
        $activity->setDescription("New Description");

        $activitySequence->addActivity($activity);

        return $this->edit($activity);;
    }

    public function edit(Activity $activity)
    {
        $this->em->persist($activity);
        $this->em->flush();

        return $activity;
    }

    public function delete(Activity $activity)
    {
        $this->em->remove($activity);
        $this->em->flush();

        return $activity;
    }
}
