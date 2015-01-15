<?php

namespace Innova\ActivityBundle\Entity\ActivityProperty;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table("innova_activity_prop_question")
 * @ORM\Entity
 */
class QuestionProperty extends AbstractProperty
{
    /**
     * Unique identifier of the question
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}