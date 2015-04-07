<?php

namespace Innova\ActivityBundle\Manager;

use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Activity Manager
 * Performs CRUD actions for Activities
 *
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
        $activity = new Activity();
        
        $activity->setActivitySequence($activitySequence);
        $activity->setPosition($activitySequence->getActivities()->count() + 1);

        return $this->edit($activity);
    }
    
    public function edit(Activity $activity)
    {
        $this->em->persist($activity);
        
        $this->em->flush();

        return $activity;
    }

    public function delete(Activity $activity)
    {
        $success = true;

        try {
            $this->em->remove($activity);
            $this->em->flush();
        } catch (\Exception $e) {
            $success = false;
        }

        return $success;
    }
}
