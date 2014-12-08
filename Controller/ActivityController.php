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
 * Class ActivityController
 * @Route(
 *      "/activity",
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
     *      options={"expose" = true}
     * )
     * @Method("GET")
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
     * @Template("InnovaActivityBundle:Player:main.html.twig")
     */
    public function displayAction(Activity $activity)
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
    public function createAction()
    {

        /*$manager = $this->container->get('innova.manager.activity_sequence_manager');

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

        $activity = $this->activityManager->create($activity);
        $activityAttrs = $this->activityManager->activityAttrs($activity);

        return new JsonResponse(array (
            'id'       => $activity->getId(),
            'name'     => $activity->getName(),
            'position' => $activity->getPosition()
        ));*/
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
    public function updateAction(Activity $activity)
    {

var_dump($activity);
        $activity = $this->activityManager->create($activity);
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
    public function deleteAction(Activity $activity)
    {


echo "delete de l'activité";die();

        $activity = $this->activityManager->deleteActivity($activity);
        $activityAttrs = $this->activityManager->activityToJson($activity);

        return new JsonResponse(array('activity' => $activityAttrs));
    }
}
