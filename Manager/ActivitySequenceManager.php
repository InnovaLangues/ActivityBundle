<?php

namespace Innova\ActivityBundle\Manager;

use JMS\DiExtraBundle\Annotation as DI;
use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;

/**
 * ActivitySequence Manager
 * @DI\Service("innova.manager.activity_sequence_manager")
 */
class ActivitySequenceManager
{
    /**
     * @DI\InjectParams({
     *  "container" = @DI\Inject("service_container")
     * })
     */
    public function __construct($container)
    {
        $this->container = $container;
        $this->em = $this->container->get('claroline.persistence.object_manager');
    }
    
    public function orderActivities(array $orderedActivityIds)
    {
        $i = 0;
        foreach ($orderedActivityIds as $activityId) {
            $i++;
            $activity = $this->em->getRepository('InnovaActivityBundle:Activity')->find($activityId);
            $activity->setPosition($i);
            $this->em->persist($activity);
        }
        
        $this->em->flush();
        
        return $this;
    }
    
    public function removeActivity($activitySequenceId, $activityId)
    {
        $activity = $this->em->getRepository('InnovaActivityBundle:Activity')->find($activityId);
        $activitySequence = $this->em->getRepository('InnovaActivityBundle:ActivitySequence')->find($activitySequenceId);
        
        $activitySequence->removeActivity($activity);
        $this->em->persist($activitySequence);
        
        $this->em->flush();
        
        return $this;
    }
    
    public function edit(ActivitySequence $activitySequence)
    {
        $this->em->persist($activitySequence);
        
        $this->em->flush();

        return $activitySequence;
    }
}