<?php

namespace Innova\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Claroline\CoreBundle\Entity\Resource\AbstractResource;

/**
 * @ORM\Table(name="innova_activitySequence")
 */
class ActivitySequence extends AbstractResource
{
    /**
     * @ORM\OneToMany(targetEntity="Innova\ActivityBundle\Entity\Activity", mappedBy="activitySequence", indexBy="id")
     */
    protected $activities;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;
}