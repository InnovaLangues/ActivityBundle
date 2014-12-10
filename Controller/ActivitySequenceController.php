<?php

namespace Innova\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use JMS\DiExtraBundle\Annotation as DI;

use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;

use Innova\ActivityBundle\Manager\ActivitySequenceManager;
use Innova\ActivityBundle\Manager\ActivityManager;

/**
 * Class ActivitySequenceController
 *
 * @Route(
 *      "/activity-sequence",
 *      name = "innova_activity_sequence"
 * )
 * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
 */
class ActivitySequenceController extends Controller
{
    /**
     * Object Manager
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $om;

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
     * Class constructor
     *
     * @DI\InjectParams({
     *      "objectManager"           = @DI\Inject("doctrine.orm.entity_manager"),
     *      "securityContext"         = @DI\Inject("security.context"),
     *      "activitySequenceManager" = @DI\Inject("innova.manager.activity_sequence_manager"),
     *      "activityManager"         = @DI\Inject("innova.manager.activity_manager"),
     * })
     */
    public function __construct(
        ObjectManager            $objectManager,
        SecurityContextInterface $securityContext,
        ActivitySequenceManager  $activitySequenceManager,
        ActivityManager          $activityManager)
    {
        $this->om                      = $objectManager;
        $this->security                = $securityContext;
        $this->activitySequenceManager = $activitySequenceManager;
        $this->activityManager         = $activityManager;
    }

    /**
     * Display an Activity Sequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence $activitySequence
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

        return array (
            '_resource' => $activitySequence,
        );
    }

    /**
     * Display form to manage Activity Sequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence $activitySequence
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

        return array (
            '_resource' => $activitySequence,
        );
    }

    /**
     * Update an ActivitySequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence $activitySequence
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

        return new JsonResponse($activitySequence);
    }

    /**
     * Add a new Activity to the sequence
     *
     * @Route(
     *      "/{activitySequenceId}/activity",
     *      name    = "innova_activity_sequence_add_activity",
     *      options = { "expose" = true }
     * )
     * @Method("POST")
     */
    public function addActivityAction(ActivitySequence $activitySequence)
    {
        if (false === $this->security->isGranted('EDIT', $activitySequence->getResourceNode())) {
            throw new AccessDeniedException();
        }

        $response = array ();

        try {
            // Create the new Activity
            $activity = $this->activityManager->create($activitySequence);

            // Build response object
            $response['status'] = 'OK';
            $response['messages'] = array (
                'activity_add_success',
            );
            $response['data'] = $activitySequence;

        } catch (\Exception $e) {
            $response['status'] = 'ERROR';
            $response['messages'] = array (
                $e->getMessage(),
            );
        }

        return new JsonResponse($response);
    }

    /**
     * Update an Activity of the sequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence $activitySequence
     * @param  \Innova\ActivityBundle\Entity\Activity         $activity
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route(
     *      "/{activitySequenceId}/activity/{activityId}",
     *      name    = "innova_activity_sequence_update_activity",
     *      options = { "expose" = true }
     * )
     * @Method("PUT")
     */
    public function updateActivityAction(ActivitySequence $activitySequence, Activity $activity)
    {
        if (false === $this->security->isGranted('EDIT', $activitySequence->getResourceNode())) {
            throw new AccessDeniedException();
        }
    }

    /**
     * Delete an Activity from the sequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence $activitySequence
     * @param  \Innova\ActivityBundle\Entity\Activity         $activity
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route(
     *      "/{activitySequenceId}/activity/{activityId}",
     *      name    = "innova_activity_sequence_remove_activity",
     *      options = { "expose" = true }
     * )
     * @Method("DELETE")
     */
    public function removeActivityAction(ActivitySequence $activitySequence, Activity $activity)
    {
        if (false === $this->security->isGranted('EDIT', $activitySequence->getResourceNode())) {
            throw new AccessDeniedException();
        }

        $response = array ();

        try {
            // Remove Activity from the sequence
            $activitySequence->removeActivity($activity);

            // Remove activity from the DB
            $this->om->remove($activity);

            // Persists changes
            $this->om->flush();

            // Build response
            $response['status'] = 'OK';
            $response['messages'] = array (
                'activity_remove_success',
            );
            $response['data'] = $activitySequence;
        } catch (\Exception $e) {
            $response['status'] = 'ERROR';
            $response['messages'] = array (
                $e->getMessage(),
            );
        }

        return new JsonResponse($response);
    }
}
