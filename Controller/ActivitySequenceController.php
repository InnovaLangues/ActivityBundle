<?php

namespace Innova\ActivityBundle\Controller;

use Claroline\CoreBundle\Entity\Workspace\Workspace;
use Innova\ActivityBundle\Entity\ActivitySequence;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
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
     *      options={"expose" = true}
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
     *      options={"expose" = true}
     * )
     * @ParamConverter("workspace", class="ClarolineCoreBundle:Workspace\Workspace", options={"mapping": {"workspaceId": "id"}})
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence", options={"mapping": {"activitySequenceId": "id"}})
     * @Method("GET")
     * @Template("InnovaActivityBundle:Editor:main.html.twig")
     */
    public function AdministrateAction(Workspace $workspace, ActivitySequence $activitySequence)
    {
         if (false === $this->container->get('security.context')->isGranted("ADMINISTRATE", $activitySequence->getResourceNode())){
            throw new AccessDeniedException();
         }

        return array (
            'workspace' => $workspace,
            'activitySequence' => $activitySequence,
        );
    }
}
