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
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
     * Security Authorization
     * @var \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $securityAuth
     */
    protected $securityAuth;
    /**
     * Security Token
     * @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $securityToken
     */
    protected $securityToken;
    
    /**
     * UsersAnswers Manager
     * @var \Innova\ActivityBundle\Manager\UsersAnswersManager
     */
    protected $usersAnswersManager;
    
    protected $router;

    /**
     * Class constructor
     *
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface        $securityAuth
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $securityToken
     * @param \Innova\ActivityBundle\Manager\UsersAnswersManager            $usersAnswersManager
     *
     * @DI\InjectParams({
     *   "securityAuth" = @DI\Inject("security.authorization_checker"),
     *   "securityToken" = @DI\Inject("security.token_storage"),
     *   "usersAnswersManager" = @DI\Inject("innova.manager.usersanswers_manager"),
     *   "router" = @DI\Inject("router"),
     * })
     */
    public function __construct(
        AuthorizationCheckerInterface $securityAuth,
        TokenStorageInterface         $securityToken,
        UsersAnswersManager      $usersAnswersManager)
    {
        $this->securityAuth    = $securityAuth;
        $this->securityToken   = $securityToken;
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
