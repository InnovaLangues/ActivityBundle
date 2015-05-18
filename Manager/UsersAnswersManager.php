<?php

namespace Innova\ActivityBundle\Manager;

use Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty;
use Innova\ActivityBundle\Entity\ActivityAnswer;
use Innova\ActivityBundle\Entity\Activity;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Users Answers Manager
 * Performs CRUD actions for Users answers
 *
 * @DI\Service("innova.manager.usersanswers_manager")
 */
class UsersAnswersManager
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

    public function get()
    {
        $list = $this->em->getRepository("InnovaActivityBundle:ActivityAnswer")->findAll();
    //    $id1 = $list[0]->getChoiceProperties()->getId();
        return $list;
    }
   
}
