<?php

namespace Innova\ActivityBundle\Controller;

use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Manager\UsersAnswersManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContextInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Class UsersAnswersController
 * @Route(
 *      "/usersAnswers",
 *      name = "innova_activity_users_answers"
 * )

 */
class UsersAnswersController
{
    /**
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $security;
    
    /**
     * UsersAnswers Manager
     * @var \Innova\ActivityBundle\Manager\UsersAnswersManager
     */
    protected $usersAnswersManager;
    
    protected $router;

    /**
     * Class constructor
     *
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $securityContext
     * @param \Innova\ActivityBundle\Manager\UsersAnswersManager            $usersAnswersManager
     *
     * @DI\InjectParams({
     *   "securityContext" = @DI\Inject("security.context"),
     *   "usersAnswersManager" = @DI\Inject("innova.manager.usersanswers_manager"),
     *   "router" = @DI\Inject("router"),
     * })
     */
    public function __construct(
        SecurityContextInterface $securityContext,
        UsersAnswersManager      $usersAnswersManager)
    {
        $this->security            = $securityContext;
        $this->usersAnswersManager = $usersAnswersManager;
    }
    
    /**
     * @Route(
     *      "/usersAnswers",
     *      name    = "innova_users_answers_get",
     *      options = { "expose" = true }
     * )
     */
    public function usersAnswersAction()
    {
        $list = $this->usersAnswersManager->get();

        return new JsonResponse($list);
    }
}
