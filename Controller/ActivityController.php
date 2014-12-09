<?php

namespace Innova\ActivityBundle\Controller;

use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Form\Handler\ActivityHandler;

use Innova\ActivityBundle\Manager\ActivityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\FormFactoryInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider;
use Symfony\Component\HttpFoundation\Session\Session;

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
     *   "formFactory"     = @DI\Inject("form.factory"),
     *   "activityHandler" = @DI\Inject("innova.form.handler.activity_handler")
     * })
     * @param \Innova\ActivityBundle\Manager\ActivityManager $activityManager
     * @param \Symfony\Component\Form\FormFactoryInterface $formFactory
     * @param \Innova\ActivityBundle\Form\Handler\ActivityHandler $activityHandler
     */
    public function __construct(
        ActivityManager      $activityManager,
        FormFactoryInterface $formFactory,
        ActivityHandler      $activityHandler)
    {
        $this->activityManager = $activityManager;
        $this->formFactory     = $formFactory;
        $this->activityHandler = $activityHandler;
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
        $params = array(
            'method' => 'PUT',
            'csrf_protection' => false,
        );

        // Create form
        $form = $this->formFactory->create('innova_activity_type', $activity, $params);

        $response = array ();

        // Try to process data
        $this->activityHandler->setForm($form);
        if ($this->activityHandler->process()) {
            // Add user message
            /*$this->session->getFlashBag()->add(
                'success', $this->translator->trans('path_save_success', array(), 'path_editor')
            );*/
            $response['status'] = 'OK';
            $response['data']   = $this->activityHandler->getData();
        }
        else {
            // Error
            // List des erreurs symfony (FormError...)
            $errors = $form->getErrors();

            // SI non fonctionnel du premier coup alors :
            // - boucler sur les erreurs Symfony
            // - pour chaque champ, 'nom_du_champ' => 'message'

            // ATTENTION : le nom du champ doit valoir nom_form_type + nom_du_champ (ex. innova_activity_type_name)

            $response['status'] = 'ERROR_VALIDATION';
            $response['messages'] = array (
                $form->getErrors(),
            );
        }

        // TODO : return soit l'entity mise à jour soit un message erreurs (erreurs de validation de form)
        return new JsonResponse($response);
    }
}
