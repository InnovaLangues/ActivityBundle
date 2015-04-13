<?php

namespace Innova\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ActivityAvailable Controller
 * @Route(
 *      "/activity_available",
 *      name="innova_activity_available"
 * )
 */
class ActivityAvailableController extends Controller
{
    /**
     * List of all available Activity types grouped by Category
     * @Route(
     *      "/",
     *      name="innova_activity_available_list",
     *      options={"expose" = true}
     * )
     * @Method("GET")
     */
    public function listAction()
    {
        // Load list of CategoryAvailable
        $types = $this->container->get('doctrine.orm.entity_manager')->getRepository('InnovaActivityBundle:ActivityAvailable\CategoryAvailable')->findAll();
        
        return new JsonResponse($types);
    }
}