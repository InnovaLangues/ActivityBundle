<?php

namespace Innova\ActivityBundle\Controller;

use Claroline\CoreBundle\Entity\Workspace\Workspace;
use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class ActivitySequenceController
 * @Route(
 *      "workspace/{workspaceId}/activity-sequence",
 *      name="innova_activity_sequence"
 * )
 * @ParamConverter("workspace", class="ClarolineCoreBundle:Workspace\Workspace", options={"mapping": {"workspaceId": "id"}})
 */
class ActivitySequenceController extends Controller
{
    /**
     * @DI\InjectParams({
     *   "activitySequenceManager" = @DI\Inject("innova.manager.activity_sequence_manager"),
     * })
     */
    public function __construct($activitySequenceManager)
    {
        $this->activitySequenceManager = $activitySequenceManager;
    }

    /**
     * @Route(
     *      "/{activitySequenceId}",
     *      name="activity_sequence_open",
     * )
     * @Method("GET")
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
     * @Template("InnovaActivityBundle:Player:main.html.twig")
     */
    public function displayAction(Workspace $workspace, ActivitySequence $activitySequence)
    {
        if (false === $this->container->get('security.context')->isGranted("OPEN", $activitySequence->getResourceNode())){
            throw new AccessDeniedException();
         }

        return array (
            'workspace' => $workspace,
            'activitySequence' => $activitySequence,
        );
    }

    /**
     * @Route(
     *      "/{activitySequenceId}/administrate",
     *      name="activity_sequence_administrate",
     * )
     * @Method("GET")
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
     * @Template("InnovaActivityBundle:Editor:main.html.twig")
     */
    public function administrateAction(Workspace $workspace, ActivitySequence $activitySequence)
    {
         if (false === $this->container->get('security.context')->isGranted("ADMINISTRATE", $activitySequence->getResourceNode())){
            throw new AccessDeniedException();
         }
         $activitySequenceAttrs = $this->activitySequenceManager->activitySequenceToJson($activitySequence);

        return array (
            'workspace' => $workspace,
            'activitySequence' => $activitySequenceAttrs,
        );
    }

    /**
     * @Route(
     *      "/",
     *      name="create_activity_sequence",
     *      options={"expose" = true}
     * )
     * @Method("POST")
     */
    public function createAction(Workspace $workspace)
    {

        /*$activitySequence = $this->activitySequenceManager->create($activitySequence);
        $activitySequenceAttrs = $this->activitySequenceManager->activityAttrs($activitySequence);*/

        return new JsonResponse(array('activitySequence' => $activitySequenceAttrs));
    }

    /**
     * @Route(
     *      "/{activitySequenceId}",
     *      name="update_activity_sequence",
     *      options={"expose" = true}
     * )
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
     * @Method("PUT")
     */
    public function updateAction(Workspace $workspace, ActivitySequence $activitySequence)
    {

        $activitySequence = $this->activitySequenceManager->create($activitySequence);
        $activitySequenceAttrs = $this->activitySequenceManager->activityAttrs($activitySequence);

        return new JsonResponse(array('activitySequence' => $activitySequenceAttrs));
    }

    /**
     * @Route(
     *      "/{activitySequenceId}",
     *      name="delete_activity_sequence",
     *      options={"expose" = true}
     * )
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
     * @Method("DELETE")
     */
    public function deleteAction(Workspace $workspace, ActivitySequence $activitySequence)
    {
        /*$activitySequence = $this->activitySequenceManager->deleteActivity($activity);*/
        $activitySequenceAttrs = $this->activitySequenceManager->activitySequenceToJson($activitySequence);

        return new JsonResponse(array('activitySequence' => $activitySequenceAttrs));
    }

    /**
     * @Route(
     *      "/order-activities/{activitySequenceId}",
     *      name="order_activities",
     *      options={"expose" = true}
     * )
     * @Method("POST")
     */
    public function orderActivitiesAction(Request $request, Workspace $workspace, ActivitySequence $activitySequence)
    {
        $order = $request->get('order');

        $activitySequence = $this->activitySequenceManager->applyOrder($activitySequence, $order);
        $activitySequenceAttrs = $this->activitySequenceManager->activitySequenceToJson($activitySequence);

        return new JsonResponse(array('activitySequence' => $activitySequenceAttrs, 'order'=>$order));
    }

    /**
     * Add a new Activity to the sequence
     * @Route(
     *      "/{activitySequenceId}/add-activity",
     *      name    = "innova_activity_sequence_add_activity",
     *      options = { "expose" = true }
     * )
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
     * @Method("POST")
     */
    public function addActivityAction(Workspace $workspace, ActivitySequence $activitySequence)
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

        return new JsonResponse(array (
            'id'       => $activity->getId(),
            'name'     => $activity->getName(),
            'position' => $activity->getPosition()
        ));
    }

    public function removeActivityAction()
    {
        // TODO
    }
}
