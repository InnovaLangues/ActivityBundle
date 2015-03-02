<?php

namespace Innova\ActivityBundle\Listener\Resource;

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
use Innova\ActivityBundle\Form\ActivityType;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use JMS\DiExtraBundle\Annotation as DI;

class ActivityListener extends ContainerAware
{
    public function onCreateForm(CreateFormResourceEvent $event)
    {
        $form = $this->container->get('form.factory')->create(new ActivityType, new Activity());
        $content = $this->container->get('templating')->render(
            'ClarolineCoreBundle:Resource:createForm.html.twig',
            array(
                'form' => $form->createView(),
                'resourceType' => 'innova_activity'
            )
        );
        $event->setResponseContent($content);
        $event->stopPropagation();
    }

    public function onCreate(CreateResourceEvent $event)
    {
        $request = $this->container->get('request');
        $form = $this->container->get('form.factory')->create(new ActivityType, new Activity());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $activity = $form->getData();

            // TODO : refactoriser le code métier qui suit dans le manager
            $typeAvailable = $activity->getTypeAvailable();
        
            if (!empty($typeAvailable)) {
                $name = "\\Innova\\ActivityBundle\\Entity\\ActivityType\\" . $typeAvailable->getClass();
                $type = new $name();
                
                $activity->setType($type);
                
                $type->setActivity($activity);
                
                $this->container->get("doctrine.orm.entity_manager")->persist($type);
            }
            
            $event->setResources(array($activity));
            $event->stopPropagation();
            
            return;
        }

        $content = $this->container->get('templating')->render(
            'ClarolineCoreBundle:Resource:createForm.html.twig',
            array(
                'form' => $form->createView(),
                'resourceType' => 'innova_activity'
            )
        );
        $event->setErrorFormContent($content);
        $event->stopPropagation();
    }

    public function onOpen(OpenResourceEvent $event)
    {
         $activity = $event->getResource();
         $route = $this->container
                ->get('router')
                ->generate(
                'innova_activity_open',
                array (
                    'activityId' => $activity->getId(),
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
     * @DI\Observe("administrate_innova_activity")
     */
    public function onAdministrate(CustomActionResourceEvent $event)
    {
        $activity = $event->getResource();

        $route = $this->container->get('router')->generate(
            'innova_activity_administrate',
            array (
                'activityId' => $activity->getId(),
            )
        );

        $event->setResponse(new RedirectResponse($route));
        $event->stopPropagation();
    }

    public function onCopy(CopyResourceEvent $event)
    {

    }
}
