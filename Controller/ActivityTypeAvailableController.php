<?php

namespace Innova\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ActivityTypeAvailable Controller
 * @Route(
 *      "/activity_type_available",
 *      name="innova_activity_type_available"
 * )
 */
class ActivityTypeAvailableController extends Controller
{
    /**
     * @Route(
     *      "/",
     *      name="innova_activity_type_available_list"
     * )
     * @Method("GET")
     */
    public function listAction()
    {
        // Load list of ActivityTypeAvailable
        $types = $this->container->get('doctrine.orm.entity_manager')->getRepository('InnovaActivityBundle:ActivityTypeAvailable')->findAll();

        return new JsonResponse($types);
    }
}