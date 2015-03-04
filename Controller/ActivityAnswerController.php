<?php

namespace Innova\ActivityBundle\Controller;

use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Entity\ActivityAvailable\TypeAvailable;
use Innova\ActivityBundle\Manager\ActivityAnswerManager;
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
 * Class ActivityController
 * @Route(
 *      "/answer",
 *      name = "innova_activity_answer"
 * )
 * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})

 */
class ActivityAnswerController
{
    /**
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $security;
    
    /**
     * Activity Manager
     * @var \Innova\ActivityBundle\Manager\ActivityAnswerManager
     */
    protected $activityAnswerManager;
    
    protected $router;

    /**
     * Class constructor
     *
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $securityContext
     * @param \Innova\ActivityBundle\Manager\ActivityAnswerManager            $activityAnswerManager
     *
     * @DI\InjectParams({
     *   "securityContext" = @DI\Inject("security.context"),
     *   "activityAnswerManager" = @DI\Inject("innova.manager.answer_manager"),
     *   "router" = @DI\Inject("router"),
     * })
     */
    public function __construct(
        SecurityContextInterface $securityContext,
        ActivityAnswerManager      $activityAnswerManager,
        $router)
    {
        $this->security        = $securityContext;
        $this->activityAnswerManager = $activityAnswerManager;
        $this->router = $router;
    }
    
    /**
     * Display an Activity
     *
     * @param  \Innova\ActivityBundle\Entity\Activity                  $activity
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return array
     *
     * @Route(
     *      "/{activityId}",
     *      name="innova_answer_create",
     * )
     * @Method("POST")
     */
    public function answerCreateAction(Activity $activity, Request $request)
    {
        $choiceIds = $request->request->get("choices");
        
        foreach ($choiceIds as $choiceId) {
            $this->activityAnswerManager->create($activity, $choiceId);
        }
        
        return new RedirectResponse($this->router->generate("innova_activity_open", array("activityId" => $activity->getId())));
    }
}
