<?php

namespace Innova\ActivityBundle\Listener;

use Claroline\CoreBundle\Event\CreateFormResourceEvent;
use Claroline\CoreBundle\Event\CreateResourceEvent;
use Claroline\CoreBundle\Event\DeleteResourceEvent;
use Claroline\CoreBundle\Event\CopyResourceEvent;
use Claroline\CoreBundle\Event\OpenResourceEvent;
use Claroline\CoreBundle\Event\DeleteUserEvent;
use Claroline\CoreBundle\Event\CustomActionResourceEvent;
use Claroline\CoreBundle\Event\PluginOptionsEvent;
use Claroline\CoreBundle\Event\ImportResourceTemplateEvent;
use Claroline\CoreBundle\Event\ExportResourceTemplateEvent;

use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Form\ActivitySequenceType;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use JMS\DiExtraBundle\Annotation as DI;

class ActivitySequenceListener extends ContainerAware
{
    public function onCreateForm(CreateFormResourceEvent $event)
    {
        $form = $this->container->get('form.factory')->create(new ActivitySequenceType, new ActivitySequence());
        $content = $this->container->get('templating')->render(
            'ClarolineCoreBundle:Resource:createForm.html.twig',
            array(
                'form' => $form->createView(),
                'resourceType' => 'innova_activity_sequence'
            )
        );
        $event->setResponseContent($content);
        $event->stopPropagation();
    }

    public function onCreate(CreateResourceEvent $event)
    {
        $request = $this->container->get('request');
        $form = $this->container->get('form.factory')->create(new ActivitySequenceType, new ActivitySequence());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $activitySequence = $form->getData();
            $event->setResources(array($activitySequence));
            $event->stopPropagation();

            return;
        }

        $content = $this->container->get('templating')->render(
            'ClarolineCoreBundle:Resource:createForm.html.twig',
            array(
                'form' => $form->createView(),
                'resourceType' => 'innova_activity_sequence'
            )
        );
        $event->setErrorFormContent($content);
        $event->stopPropagation();
    }

    public function onOpen(OpenResourceEvent $event)
    {
         $activitySequence = $event->getResource();
         $route = $this->container
                ->get('router')
                ->generate(
                'activity_sequence_open',
                array(
                    'workspaceId' => $activitySequence->getResourceNode()->getWorkspace()->getId(),
                    'activitySequenceId' => $activitySequence->getId(),
                )
            );

            $event->setResponse(new RedirectResponse($route));
            $event->stopPropagation();
    }

    public function onDelete(DeleteResourceEvent $event)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $em->remove($event->getResource());
        $event->stopPropagation();
    }

    /**
    * @DI\Observe("administrate_innova_activity_sequence")
    */
    public function onAdministrate(CustomActionResourceEvent $event)
    {
        $activitySequence = $event->getResource();
        $workspaceId = $activitySequence->getResourceNode()->getWorkspace()->getId();

        $route = $this->container->get('router')->generate(
                                                                                    'activity_sequence_administrate',
                                                                                    array(
                                                                                        'workspaceId' => $workspaceId,
                                                                                        'activitySequenceId' => $activitySequence->getId(),
                                                                                    )
                                                                            );
        $event->setResponse(new RedirectResponse($route));
        $event->stopPropagation();
    }
}
