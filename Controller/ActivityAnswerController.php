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
 * @ParamConverter("choice", class="InnovaActivityBundle:ActivityProperty\ChoiceProperty", options = { "mapping" : {"answerId" : "id"} })

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
     * Save an answer
     * @Route(
     *      "/{activityId}/{answerId}",
     *      name="innova_answer_create",
     *      options = { "expose" = true }
     * )
     * @Method("POST")
     */
    public function answerCreateAction(Activity $activity, ChoiceProperty $choice)
    {
        $response = array();
        try {
            // Create the new Activity
            $this->activityAnswerManager->create($activity, $choice);
        
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
