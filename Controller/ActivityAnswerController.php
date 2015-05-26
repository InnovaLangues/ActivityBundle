<?php

namespace Innova\ActivityBundle\Controller;

use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Entity\ActivityProperty\ChoiceProperty;
use Innova\ActivityBundle\Entity\ActivityAvailable\TypeAvailable;
use Innova\ActivityBundle\Manager\ActivityAnswerManager;
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
 * Class ActivityController
 * @Route(
 *      "/answer",
 *      name = "innova_activity_answer"
 * )
 * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
 * @ParamConverter("choice", class="InnovaActivityBundle:ActivityProperty\ChoiceProperty", options = { "mapping" : {"answerId" : "id"} })

 */
class ActivityAnswerController
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
     * Activity Manager
     * @var \Innova\ActivityBundle\Manager\ActivityAnswerManager
     */
    protected $activityAnswerManager;
    
    protected $router;

    /**
     * Class constructor
     *
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface        $securityAuth
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $securityToken
     * @param \Innova\ActivityBundle\Manager\ActivityAnswerManager            $activityAnswerManager
     *
     * @DI\InjectParams({
     *   "securityContext" = @DI\Inject("security.context"),
     *   "activityAnswerManager" = @DI\Inject("innova.manager.answer_manager"),
     *   "router" = @DI\Inject("router"),
     * })
     */
    public function __construct(
        AuthorizationCheckerInterface $securityAuth,
        TokenStorageInterface         $securityToken,
        ActivityAnswerManager      $activityAnswerManager,
        $router)
    {
        $this->securityAuth    = $securityAuth;
        $this->securityToken   = $securityToken;
        $this->activityAnswerManager = $activityAnswerManager;
        $this->router = $router;
    }
    
    /**
     * Save an answer
     * @Route(
     *      "/{activityId}/{answerId}/{trial}",
     *      name="innova_answer_create",
     *      options = { "expose" = true }
     * )
     * @Method("POST")
     */
    public function answerCreateAction(Activity $activity, ChoiceProperty $choice, $trial)
    {
        $response = array();
        try {
            // Create the new Activity
            $this->activityAnswerManager->create($activity, $choice, $trial);
        
            // Build response object
            $response['status'] = 'OK';
            $response['messages'] = array(
                'activity_create_success',
            );
        } catch (\Exception $e) {
            $response['status'] = 'ERROR';
            $response['messages'] = array(
                $e->getMessage(),
            );
        }
        
        return new JsonResponse($response);
    }
}
