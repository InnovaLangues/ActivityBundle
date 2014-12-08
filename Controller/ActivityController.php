<?php

namespace Innova\ActivityBundle\Controller;

use Claroline\CoreBundle\Entity\Workspace\Workspace;
use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Form\Handler\PathHandler;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\FormFactoryInterface;

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

        /**
         * recopie de EditController du PathBundle
         */
        $params = array();
        if (!empty($httpMethod)) {
            $params['method'] = $httpMethod;
        }
        // Create form
        $form = $this->formFactory->create('innova_path', $path, $params);

        // Try to process data
        $this->pathHandler->setForm($form);
        if ($this->pathHandler->process()) {
            // Add user message
            $this->session->getFlashBag()->add(
                'success', $this->translator->trans('path_save_success', array(), 'path_editor')
            );

            $saveAndClose = $form->get('saveAndClose')->getData();
            $saveAndClose = filter_var($saveAndClose, FILTER_VALIDATE_BOOLEAN);

            if (!$saveAndClose) {
                // Redirect to editor
                $url = $this->router->generate('innova_path_editor_edit', array(
                    'workspaceId' => $workspace->getId(),
                    'id' => $path->getId(),
                ));
            } else {
                // Redirect to list of paths
                $url = $this->router->generate('claro_workspace_open_tool', array(
                    'workspaceId' => $workspace->getId(),
                    'toolName' => 'innova_path',
                ));
            }

            // Redirect to list
            return new RedirectResponse($url);
        }

        // Get workspace root directory
        $wsDirectory = $this->resourceManager->getWorkspaceRoot($workspace);
        $resourceTypes = $this->om->getRepository('ClarolineCoreBundle:Resource\ResourceType')->findAll();
        $resourceIcons = $this->om->getRepository('ClarolineCoreBundle:Resource\ResourceIcon')->findByIsShortcut(false);

        return array(
            'workspace' => $workspace,
            'wsDirectoryId' => $wsDirectory->getId(),
            'resourceTypes' => $resourceTypes,
            'resourceIcons' => $resourceIcons
        );
        /**
         * FIN recopie de EditController du PathBundle
         */

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
