<?php

namespace Innova\ActivityBundle\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\FormFactoryInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormInterface;
use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Form\Handler\ActivitySequenceHandler;
use Innova\ActivityBundle\Manager\ActivitySequenceManager;
use Innova\ActivityBundle\Manager\ActivityManager;
use Claroline\CoreBundle\Manager\ResourceManager;

/**
 * Class ActivitySequenceController
 *
 * @Route(
 *      "/activity-sequence",
 *      name = "innova_activity_sequence"
 * )
 * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
 */
class ActivitySequenceController
{
    /**
     * Object Manager
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $om;

    /**
     * Security
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $security;

    /**
     * ActivitySequence Manager
     * @var \Innova\ActivityBundle\Manager\ActivitySequenceManager
     */
    protected $activitySequenceManager;

    /**
     * Activity Manager
     * @var \Innova\ActivityBundle\Manager\ActivityManager
     */
    protected $activityManager;

    /**
     * Resource Manager
     * @var \Claroline\CoreBundle\Manager\ResourceManager 
     */
    protected $resourceManager;

	/**
     * Form factory
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    protected $formFactory;

    /**
     * Activity form handler
     * @var \Innova\ActivityBundle\Form\Handler\ActivitySequenceHandler
     */
    protected $activitySequenceHandler;

    /**
     * Class constructor
     *
     * @DI\InjectParams({
     *      "objectManager"           = @DI\Inject("doctrine.orm.entity_manager"),
     *      "securityContext"         = @DI\Inject("security.context"),
     *      "activitySequenceManager" = @DI\Inject("innova.manager.activity_sequence_manager"),
     *      "activityManager"         = @DI\Inject("innova.manager.activity_manager"),
     *      "resourceManager"         = @DI\Inject("claroline.manager.resource_manager"),
     *      "formFactory"             = @DI\Inject("form.factory"),
     *      "activitySequenceHandler" = @DI\Inject("innova_activity_sequence.form.handler.activity")
     * })
     */
    public function __construct(
        ObjectManager            $objectManager,
        SecurityContextInterface $securityContext,
        ActivitySequenceManager  $activitySequenceManager,
        ActivityManager          $activityManager,
        ResourceManager          $resourceManager,
        FormFactoryInterface     $formFactory,
        ActivitySequenceHandler  $activitySequenceHandler
    )
    {
        $this->om                      = $objectManager;
        $this->security                = $securityContext;
        $this->activitySequenceManager = $activitySequenceManager;
        $this->activityManager         = $activityManager;
        $this->resourceManager          = $resourceManager;
        $this->formFactory             = $formFactory;
        $this->activitySequenceHandler = $activitySequenceHandler;
    }

    /**
     * Display an Activity Sequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence                   $activitySequence
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return array
     *
     * @Route(
     *      "/{activitySequenceId}",
     *      name="innova_activity_sequence_open",
     * )
     * @Method("GET")
     * @Template()
     */
    public function showAction(ActivitySequence $activitySequence)
    {
        if (false === $this->security->isGranted('OPEN', $activitySequence->getResourceNode())) {
            throw new AccessDeniedException();
        }

        return array(
            '_resource' => $activitySequence,
        );
    }

    /**
     * Display form to manage Activity Sequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence                   $activitySequence
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return array
     *
     * @Route(
     *      "/{activitySequenceId}/administrate",
     *      name = "innova_activity_sequence_administrate",
     * )
     * @Method("GET")
     * @Template()
     */
    public function administrateAction(ActivitySequence $activitySequence)
    {
        if (false === $this->security->isGranted('ADMINISTRATE', $activitySequence->getResourceNode())) {
            throw new AccessDeniedException();
        }
        
        // Get workspace root directory
        $workspace = $activitySequence->getResourceNode()->getWorkspace();
        $wsDirectory = $this->resourceManager->getWorkspaceRoot($workspace);
        $resourceTypes = $this->om->getRepository('ClarolineCoreBundle:Resource\ResourceType')->findAll();
        
        return array(
            'workspace' => $workspace,
            'wsDirectoryId' => $wsDirectory->getId(),
            'resourceTypes' => $resourceTypes,
             '_resource' => $activitySequence,
        );
    }

    /**
     * Update an ActivitySequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence                   $activitySequence
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route(
     *      "/{activitySequenceId}",
     *      name    = "innova_activity_sequence_update",
     *      options = {"expose" = true}
     * )
     * @Method("PUT")
     */
    public function updateAction(ActivitySequence $activitySequence)
    {
        if (false === $this->security->isGranted('EDIT', $activitySequence->getResourceNode())) {
            throw new AccessDeniedException();
        }
        
        $params = array(
            'method' => 'PUT',
            'csrf_protection' => false,
        );

        // Create form
        $form = $this->formFactory->create('innova_activity_sequence', $activitySequence, $params);

        $response = array();

        // Try to process data
        $this->activitySequenceHandler->setForm($form);
        if ($this->activitySequenceHandler->process()) {
            // Add user message
            $response['status']   = 'OK';
            $response['messages'] = array ();
            $response['data']     = $this->activitySequenceHandler->getData();
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

    /**
     * Order an ActivitySequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence                   $activitySequence
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route(
     *      "/{activitySequenceId}/{order}",
     *      name    = "innova_activity_sequence_update_order",
     *      options = {"expose" = true}
     * )
     * @Method("PUT")
     */
    public function updateActivitiesOrderAction(ActivitySequence $activitySequence, $order)
    {
        if (false === $this->security->isGranted('ADMINISTRATE', $activitySequence->getResourceNode())) {
            throw new AccessDeniedException();
        }

        $orderedActivityIds = explode(",", $order);
        if (!empty($orderedActivityIds)) {
            $this->activitySequenceManager->orderActivities($orderedActivityIds);
        }

        return new JsonResponse($activitySequence);
    }

    /**
     * Remove an Activity in an ActivitySequence
     *
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence                   $activitySequence
     * @param  \Innova\ActivityBundle\Entity\Activity                           $activity
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route(
     *      "/{activitySequenceId}/{activityId}",
     *      name    = "innova_activity_sequence_remove_activity",
     *      options = {"expose" = true}
     * )
     * @Method("POST")
     */
    public function removeActivityAction(ActivitySequence $activitySequence, $activity)
    {
        $this->activitySequenceManager->removeActivity($activitySequence->getId(), $activity->getId());

        return new JsonResponse($activitySequence);
    }
}
