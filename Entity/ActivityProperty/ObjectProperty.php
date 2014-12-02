<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Object
 *
 * @ORM\Table("innova_activity_prop_object")
 * @ORM\Entity
 */
class ObjectProperty extends AbstractProperty
{
    /**
     * Unique identifier of the object
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}