<?php

namespace Innova\ActivityBundle\Listener;

/**
 * ActivityListener
 * Manages Life cycle of the Activity listener
 */
class ActivityListener
{
    /**
     * When an Activity is loaded, we need to load it's dedicated ActivityType data (e.g. UniqueChoiceType)
     * @param $event
     * @return ActivityListener
     */
    public function postLoad($event)
    {
        return $this;
    }

    /**
     * When an Activity is persisted, persist it's dedicated ActivityType data too
     * @param $event
     * @return ActivityListener
     */
    public function prePersist($event)
    {

        return $this;
    }
}