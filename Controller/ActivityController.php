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
     * )
     * @ParamConverter("workspace", class="ClarolineCoreBundle:Workspace\Workspace", options={"mapping": {"workspaceId": "id"}})
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
     * @Method("GET")
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
     *      "administrate/{activityId}",
     *      name="activity_administrate",
     * )
     * @ParamConverter("workspace", class="ClarolineCoreBundle:Workspace\Workspace", options={"mapping": {"workspaceId": "id"}})
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activity": "id"}})
     * @Method("PUT")
     * @Template("InnovaActivityBundle:Editor:main.html.twig")
     */
    public function administrateAction(Workspace $workspace, Activity $activity)
    {
         if (false === $this->container->get('security.context')->isGranted("ADMINISTRATE", $activity->getResourceNode())){
            throw new AccessDeniedException();
         }
         $activityAttrs = $this->activityManager->activityJson($activity);

        return array (
            'workspace' => $workspace,
            'activity' => $activityAttrs,
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
    public function createActivityAction(Activity $activity)
    {

        $activity = $this->activityManager->addActivity($activity);
        $activityAttrs = $this->activityManager->activityAttrs($activity);

        return new JsonResponse(array('activity' => $activityAttrs));
    }

    /**
     * @Route(
     *      "/",
     *      name="update_activity",
     *      options={"expose" = true}
     * )
     * @Method("PUT")
     */
    public function updateActivityAction(Activity $activity)
    {

        $activity = $this->activityManager->addActivity($activity);
        $activityAttrs = $this->activityManager->activityAttrs($activity);

        return new JsonResponse(array('activity' => $activityAttrs));
    }

    /**
     * @Route(
     *      "/delete/{activityId}",
     *      name="delete_activity",
     *      options={"expose" = true}
     * )
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
     * @Method("DELETE")
     */
    public function deleteActivityAction(Activity $activity)
    {
        $activity = $this->activityManager->deleteActivity($activity);
        $activityAttrs = $this->activityManager->activityToJson($activity);

        return new JsonResponse(array('activity' => $activityAttrs));
    }
}
