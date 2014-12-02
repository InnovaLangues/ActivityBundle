<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Instruction
 *
 * @ORM\Table("innova_activity_prop_instruction")
 * @ORM\Entity
 */
class InstructionProperty extends AbstractProperty
{
    /**
     * Unique identifier of the instruction
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}