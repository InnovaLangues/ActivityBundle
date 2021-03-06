<?php

namespace Innova\ActivityBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Innova\ActivityBundle\Entity\Activity;

/**
 * ActivityListener
 * Manages Life cycle of the Activity listener
 */
class ActivityListener
{
    /**
     * When an Activity is loaded, we need to load it's dedicated ActivityType data (e.g. UniqueChoiceType)
     * @param  \Innova\ActivityBundle\Entity\Activity $activity
     * @param  \Doctrine\ORM\Event\LifecycleEventArgs $event
     * @return ActivityListener
     */
    public function postLoad(Activity $activity, LifecycleEventArgs $event)
    {
        $typeAvailable = $activity->getTypeAvailable();
        
        if (!empty($typeAvailable)) {
            $repository = $event->getEntityManager()->getRepository("InnovaActivityBundle:ActivityType\\" . $typeAvailable->getClass());
            $type = $repository->findOneBy(array(
                "activity" => $activity->getId(),
            ));
            
            if (!empty($type)) {
                $activity->setType($type);
            }
        }
        
        if ($activity->getNumTries() === -1) {
            $numTries = $activity->getActivitySequence()->getNumTries();
            $activity->setNumTries($numTries);
            $event->getEntityManager()->persist($activity);
        }
        
        return $this;
    }

    /**
     * When an Activity is persisted, persist it's dedicated ActivityType data too
     * @param  \Innova\ActivityBundle\Entity\Activity $activity
     * @param  \Doctrine\ORM\Event\LifecycleEventArgs $event
     * @return ActivityListener
     */
    public function prePersist(Activity $activity, LifecycleEventArgs $event)
    {
        
        $type = $activity->getType();
        
        // Créer le type
        if (null === $type) {
            $class = "Innova\ActivityBundle\Entity\ActivityType\\" . $activity->getTypeAvailable()->getClass();
            $type = new $class();
            $type->setActivity($activity);
        }
        
        if (!empty($type) && $type instanceof \Innova\ActivityBundle\Entity\ActivityType\AbstractType) {
            $event->getEntityManager()->persist($type);
        }
        
        return $this;
    }
}