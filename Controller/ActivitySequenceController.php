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
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use JMS\DiExtraBundle\Annotation as DI;

class ActivitySequenceController extends Controller
{
    /**
     * @Route(
     *      "workspace/{workspaceId}/activity-sequence/{activitySequenceId}",
     *      name="activity_sequence_open",
     * )
     * @ParamConverter("workspace", class="ClarolineCoreBundle:Workspace\Workspace", options={"mapping": {"workspaceId": "id"}})
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
     * @Method("GET")
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
     *      "workspace/{workspaceId}/activity-sequence/{activitySequenceId}/administrate",
     *      name="activity_sequence_administrate",
     * )
     * @ParamConverter("workspace", class="ClarolineCoreBundle:Workspace\Workspace", options={"mapping": {"workspaceId": "id"}})
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
     * @Method("GET")
     * @Template("InnovaActivityBundle:Editor:main.html.twig")
     */
    public function administrateAction(Workspace $workspace, ActivitySequence $activitySequence)
    {
         if (false === $this->container->get('security.context')->isGranted("ADMINISTRATE", $activitySequence->getResourceNode())){
            throw new AccessDeniedException();
         }
         $activitySequenceAttrs = $this->container->get("innova.manager.activity_sequence_manager")->activitySequenceToJson($activitySequence);
        

        return array (
            'workspace' => $workspace,
            'activitySequence' => $activitySequenceAttrs,
        );
    }

    /**
     * @Route(
     *      "/activity-sequence/{activitySequenceId}/add-activity",
     *      name="activity_sequence_add_activity",
     *      options={"expose" = true}
     * )
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
     * @Method("GET")
     */
    public function addActivityAction(ActivitySequence $activitySequence)
    {
        $activity = $this->container->get("innova.manager.activity_sequence_manager")->addActivity($activitySequence);
        $activityAttrs = $this->container->get("innova.manager.activity_sequence_manager")->activityAttrs($activity);

        return new JsonResponse(array('activity' => $activityAttrs));
    }

    /**
     * @Route(
     *      "/{activityId}/delete",
     *      name="delete_activity",
     *      options={"expose" = true}
     * )
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
     * @Method("DELETE")
     */
    public function deleteActivityAction(Activity $activity)
    {
        $this->container->get("innova.manager.activity_sequence_manager")->deleteActivity($activity);

        return new JsonResponse();
    }

}
