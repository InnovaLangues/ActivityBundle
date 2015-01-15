<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Information
 *
 * @ORM\Table("innova_activity_prop_info")
 * @ORM\Entity
 */
class InfoProperty extends AbstractProperty
{
    /**
     * Unique identifier of the info
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}