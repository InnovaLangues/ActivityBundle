<?php

namespace Innova\ActivityBundle\Controller;

use Claroline\CoreBundle\Entity\Workspace\Workspace;
use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class ActivityController
 * @Route(
 *      "activity_sequence/{activitySequenceId}/activity",
 *      name="innova_activity"
 * )
 *
 * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
 */
class ActivityController extends Controller
{
    /**
     * @Route(
     *      "/{activityId}",
     *      name="activity_open",
     *      options={"expose" = true}
     * )
     * @Method("GET")
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
     * @Template("InnovaActivityBundle:Player:main.html.twig")
     */
    public function displayAction(ActivitySequence $activitySequence, Activity $activity)
    {
        if (false === $this->container->get('security.context')->isGranted("OPEN", $activity->getResourceNode())){
            throw new AccessDeniedException();
        }

        return array (
            'activity' => $activity,
        );
    }

    /**
     * Create a new Activity
     * @Route(
     *      "/",
     *      name    = "innova_activity_create",
     *      options = { "expose" = true }
     * )
     * @Method("POST")
     */
    public function createAction(ActivitySequence $activitySequence)
    {

        $manager = $this->container->get('innova.manager.activity_sequence_manager');

        $om = $this->container->get('doctrine.orm.entity_manager');

        // Create the new Activity
        $activity = new Activity();

        $activity->setName('New Activity');
        $activity->setDescription('New Description');

        // Appel méthode pour ajouter +1 à la position
        $position = $manager->countActivities($activitySequence);

        $activity->setPosition($position);

        // Attach the Activity to the Sequence
        $activitySequence->addActivity($activity);

        // Save to the DB
        $om->flush();

        /*$activity = $this->activityManager->create($activity);
        $activityAttrs = $this->activityManager->activityAttrs($activity);*/

        return new JsonResponse($activity);
    }

    /**
     * @Route(
     *      "/{activityId}",
     *      name="update_activity",
     *      options={"expose" = true}
     * )
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
     * @Method("PUT")
     */
    public function updateAction(ActivitySequence $activitySequence, Activity $activity)
    {



        $activity = $this->activityManager->addActivity($activity);
        $activityAttrs = $this->activityManager->activityAttrs($activity);

        return new JsonResponse(array('activity' => $activityAttrs));
    }

    /**
     * @Route(
     *      "/{activityId}",
     *      name="delete_activity",
     *      options={"expose" = true}
     * )
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
     * @Method("DELETE")
     */
    public function deleteAction(ActivitySequence $activitySequence, Activity $activity)
    {
        $activity = $this->activityManager->deleteActivity($activity);
        $activityAttrs = $this->activityManager->activityToJson($activity);

        return new JsonResponse(array('activity' => $activityAttrs));
    }
}
