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

    public function create(ActivitySequence $activitySequence)
    {
        $activityType = "UniqueChoiceType"; // For tests. Eric.

        $activity = $this->em->factory('Innova\ActivityBundle\Entity\ActivityType\\' . $activityType);
        $activity->setName("New Activity");
        $activity->setDescription("New Description");

        $activity = $this->add($activity, $activityType);

        $activity->setActivitySequence($activitySequence);

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
