<?php

namespace Innova\ActivityBundle\Controller;

use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Manager\MediaTypeManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Class MediaTypeController
 * @Route(
 *      "/mediaType",
 *      name = "innova_activity_media_type"
 * )

 */
class MediaTypeController
{
    /**
     * Security Authorization
     * @var \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $securityAuth
     */
    protected $securityAuth;
    /**
     * Security Token
     * @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $securityToken
     */
    protected $securityToken;
    
    /**
     * MediaType Manager
     * @var \Innova\ActivityBundle\Manager\MediaTypeManager
     */
    protected $mediaTypeManager;
    
    protected $router;

    /**
     * Class constructor
     *
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface        $securityAuth
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $securityToken
     * @param \Innova\ActivityBundle\Manager\MediatypeManager            $MediaTypeManager
     *
     * @DI\InjectParams({
     *   "securityContext" = @DI\Inject("security.context"),
     *   "mediaTypeManager" = @DI\Inject("innova.manager.mediatype_manager"),
     *   "router" = @DI\Inject("router"),
     * })
     */
    public function __construct(
        AuthorizationCheckerInterface $securityAuth,
        TokenStorageInterface         $securityToken,
        MediaTypeManager         $mediaTypeManager)
    {
        $this->securityAuth    = $securityAuth;
        $this->securityToken   = $securityToken;
        $this->mediaTypeManager = $mediaTypeManager;
    }
    
    /**
     * @Route(
     *      "/mediaType",
     *      name    = "innova_media_type_get",
     *      options = { "expose" = true }
     * )
     */
    public function mediaTypeAction()
    {
        $list = $this->mediaTypeManager->get();

        return new JsonResponse($list);
    }
}
