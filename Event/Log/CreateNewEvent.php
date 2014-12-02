<?php

namespace Innova\ActivityBundle\Event\Log;

use Claroline\CoreBundle\Event\Log\AbstractLogResourceEvent;
use Innova\ActivityBundle\Entity\Activity;

class CreateActivityEvent extends AbstractLogResourceEvent
{
    const ACTION = 'resource-innova_activity-create_activity';

    /**
     * @param Subject $subject
     */
    public function __construct(Activity $activity)
    {
        $details = array(
            'activity' => array (
                'id' => $activity->getId()
            )
        );

        parent::__construct($activity->getResourceNode(), $details);
    }

    /**
     * @return array
     */
    public static function getRestriction()
    {
        return array(self::DISPLAYED_WORKSPACE, self::DISPLAYED_ADMIN);
    }
}
