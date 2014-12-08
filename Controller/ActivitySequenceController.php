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
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence   $activitySequence
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return array
     *
     * @Route(
     *      "/{activitySequenceId}",
     *      name="activity_sequence_open",
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
     *      name = "activity_sequence_administrate",
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
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route(
     *      "/{activitySequenceId}",
     *      name    = "update_activity_sequence",
     *      options = {"expose" = true}
     * )
     * @Method("PUT")
     */
    public function updateAction(ActivitySequence $activitySequence)
    {

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
        // Create the new Activity
        $activity = new Activity();

        $activity->setName('New Activity');
        $activity->setDescription('New Description');

        // Attach the Activity to the Sequence (it's position will be automatically calculated)
        $activitySequence->addActivity($activity);

        // Save to the DB
        $this->om->flush();

        return new JsonResponse(array (
            'id'       => $activity->getId(),
            'name'     => $activity->getName(),
            'position' => $activity->getPosition()
        ));
    }

    /**
     * Update an Activity of the sequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence $activitySequence
     * @param  \Innova\ActivityBundle\Entity\Activity         $activity
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

    }

    /**
     * Delete an Activity from the sequence
     *
     * @param  \Innova\ActivityBundle\Entity\ActivitySequence $activitySequence
     * @param  \Innova\ActivityBundle\Entity\Activity         $activity
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
        $response = array ();

        try {
            // Remove Activity from the sequence
            $activitySequence->removeActivity($activity);

            // Remove activity from the DB
            $this->om->remove($activity);

            // Persists changes
            $this->om->flush();

            $response['status'] = 'OK';
        } catch (\Exception $e) {
            $response['status'] = 'ERROR';
            $response['message'] = $e->getMessage();
        }

        return new JsonResponse($response);
    }
}
