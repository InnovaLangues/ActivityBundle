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
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class ActivityController
 * @Route(
 *      "workspace/{workspaceId}/activity",
 *      name="innova_activity"
 * )
 *
 * @ParamConverter("workspace", class="ClarolineCoreBundle:Workspace\Workspace", options={"mapping": {"workspaceId": "id"}})
 */
class ActivityController extends Controller
{

    /**
     * @DI\InjectParams({
     *   "activityManager" = @DI\Inject("innova.manager.activity_manager"),
     * })
     */
    public function __construct($activityManager)
    {
        $this->activityManager = $activityManager;
    }

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
    public function displayAction(Workspace $workspace, Activity $activity)
    {
        if (false === $this->container->get('security.context')->isGranted("OPEN", $activity->getResourceNode())){
            throw new AccessDeniedException();
        }

        return array (
            'workspace' => $workspace,
            'activity' => $activity,
        );
    }

    /**
     * @Route(
     *      "/",
     *      name="create_activity",
     *      options={"expose" = true}
     * )
     * @Method("POST")
     */
    public function createAction(Workspace $workspace)
    {

        $activity = new Activity();
        $activity = $this->activityManager->create($activity);
        $activityAttrs = $this->activityManager->activityAttrs($activity);

        return new JsonResponse(array('activity' => $activityAttrs));
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
    public function updateAction(Workspace $workspace, Activity $activity)
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
    public function deleteAction(Workspace $workspace, Activity $activity)
    {
        $activity = $this->activityManager->deleteActivity($activity);
        $activityAttrs = $this->activityManager->activityToJson($activity);

        return new JsonResponse(array('activity' => $activityAttrs));
    }
}
