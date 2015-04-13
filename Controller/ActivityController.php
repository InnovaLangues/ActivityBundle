<?php

namespace Innova\ActivityBundle\Controller;

use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Entity\ActivityAvailable\TypeAvailable;
use Innova\ActivityBundle\Form\Handler\ActivityHandler;
use Innova\ActivityBundle\Manager\ActivityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\FormFactoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Form\FormInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class ActivityController
 * @Route(
 *      "/activity",
 *      name = "innova_activity"
 * )
 * @ParamConverter("activity", class="InnovaActivityBundle:Activity", isOptional=true, options={"mapping": {"activityId": "id"}})

 */
class ActivityController
{
    /**
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $security;
    /**
     * Activity Manager
     * @var \Innova\ActivityBundle\Manager\ActivityManager
     */
    protected $activityManager;

    /**
     * Form factory
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    protected $formFactory;

    /**
     * Activity form handler
     * @var \Innova\ActivityBundle\Form\Handler\ActivityHandler
     */
    protected $activityHandler;

    /**
     * Class constructor
     *
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $securityContext
     * @param \Innova\ActivityBundle\Manager\ActivityManager            $activityManager
     * @param \Symfony\Component\Form\FormFactoryInterface              $formFactory
     * @param \Innova\ActivityBundle\Form\Handler\ActivityHandler       $activityHandler
     *
     * @DI\InjectParams({
     *   "securityContext" = @DI\Inject("security.context"),
     *   "activityManager" = @DI\Inject("innova.manager.activity_manager"),
     *   "formFactory"     = @DI\Inject("form.factory"),
     *   "activityHandler" = @DI\Inject("innova_activity.form.handler.activity")
     * })
     */
    public function __construct(
        SecurityContextInterface $securityContext,
        ActivityManager      $activityManager,
        FormFactoryInterface $formFactory,
        ActivityHandler      $activityHandler)
    {
        $this->security        = $securityContext;
        $this->activityManager = $activityManager;
        $this->formFactory     = $formFactory;
        $this->activityHandler = $activityHandler;
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
     *      name="innova_activity_open",
     * )
     * @Method("GET")
     * @Template()
     */
    public function showAction(Activity $activity)
    {
        if (false === $this->security->isGranted('OPEN', $activity->getResourceNode())) {
            throw new AccessDeniedException();
        }

        return array(
            '_resource' => $activity,
        );
    }
    
    /**
     * Display form to manage Activity
     *
     * @param  \Innova\ActivityBundle\Entity\Activity $activity
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return array
     *
     * @Route(
     *      "/{activityId}/administrate",
     *      name = "innova_activity_administrate",
     * )
     * @Method("GET")
     * @Template()
     */
    public function administrateAction(Activity $activity)
    {
        if (false === $this->security->isGranted('ADMINISTRATE', $activity->getResourceNode())) {
            throw new AccessDeniedException();
        }

        return array(
            '_resource' => $activity,
        );
    }
    
        /**
     * Create a new Activity
     * @Route(
     *      "/{activitySequenceId}/{typeAvailableId}",
     *      name    = "innova_activity_create",
     *      options = { "expose" = true }
     * )
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence",                options = { "mapping" : {"activitySequenceId" : "id"} })
     * @ParamConverter("typeAvailable",    class="InnovaActivityBundle:ActivityAvailable\TypeAvailable", options = { "mapping" : {"typeAvailableId" : "id"} })
     * @Method("POST")
     */
    public function createAction(ActivitySequence $activitySequence, TypeAvailable $typeAvailable)
    {
        $response = array();
        try {
            // Create the new Activity
            $activity = $this->activityManager->create($activitySequence, $typeAvailable);
        
            // Build response object
            $response['status'] = 'OK';
            $response['messages'] = array(
                'activity_create_success',
            );
            $response['data'] = $activity;
        } catch (\Exception $e) {
            $response['status'] = 'ERROR';
            $response['messages'] = array(
                $e->getMessage(),
            );
        }
        
        return new JsonResponse($response);
    }

    /**
     * @Route(
     *      "/{activityId}",
     *      name    = "innova_activity_update",
     *      options = { "expose" = true }
     * )
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
     * @Method("PUT")
     */
    public function updateAction(Activity $activity)
    {
        $params = array(
            'method' => 'PUT',
            'csrf_protection' => false,
        );

        // Create form
        $form = $this->formFactory->create('innova_activity', $activity, $params);

        $response = array();

        // Try to process data
        $this->activityHandler->setForm($form);
        if ($this->activityHandler->process()) {
            // Add user message
            $response['status']   = 'OK';
            $response['messages'] = array ();
            $response['data']     = $this->activityHandler->getData();
        } else {
            // Error
            $response['status']   = 'ERROR_VALIDATION';
            $response['messages'] = $this->getFormErrors($form);
            $response['data']     = null;
        }

        return new JsonResponse($response);
    }

    private function getFormErrors(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $key => $error) {
            $errors[$key] = $error->getMessage();
        }

        // Get errors from children
        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getFormErrors($child);
            }
        }

        return $errors;
    }
}
