<?php

namespace Innova\ActivityBundle\Controller;

use Innova\ActivityBundle\Entity\ActivitySequence;
use Innova\ActivityBundle\Entity\Activity;
use Innova\ActivityBundle\Entity\ActivityAvailable\TypeAvailable;
use Innova\ActivityBundle\Form\Handler\ActivityHandler;
use Innova\ActivityBundle\Manager\ActivityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\FormFactoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\FormInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class ActivityController
 * @Route(
 *      "/activity",
 *      name = "innova_activity"
 * )
 */
class ActivityController
{
    /**
     * Activity Manager
     * @var \Innova\ActivityBundle\Manager\ActivityManager
     */
    protected $activityManager;

    /**
     * Form factory
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    protected $formFactory;

    /**
     * Activity form handler
     * @var \Innova\ActivityBundle\Form\Handler\ActivityHandler
     */
    protected $activityHandler;

    /**
     * @DI\InjectParams({
     *   "activityManager" = @DI\Inject("innova.manager.activity_manager"),
     *   "formFactory"     = @DI\Inject("form.factory"),
     *   "activityHandler" = @DI\Inject("innova_activity.form.handler.activity")
     * })
     * @param \Innova\ActivityBundle\Manager\ActivityManager      $activityManager
     * @param \Symfony\Component\Form\FormFactoryInterface        $formFactory
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
     * Create a new Activity
     * @Route(
     *      "/{activitySequenceId}/{typeAvailableId}",
     *      name    = "innova_activity_create",
     *      options = { "expose" = true }
     * )
     * @ParamConverter("activitySequence", class="InnovaActivityBundle:ActivitySequence",                options = { "mapping" : {"activitySequenceId" : "id"} })
     * @ParamConverter("typeAvailable",    class="InnovaActivityBundle:ActivityAvailable\TypeAvailable", options = { "mapping" : {"typeAvailableId" : "id"} })
     * @Method("POST")
     */
    public function createAction(ActivitySequence $activitySequence, TypeAvailable $typeAvailable)
    {
        $response = array();
        try {
            // Create the new Activity
            $activity = $this->activityManager->create($activitySequence, $typeAvailable);
            // Build response object
            $response['status'] = 'OK';
            $response['messages'] = array(
                'activity_create_success',
            );
            $response['data'] = $activity;
        } catch (\Exception $e) {
            $response['status'] = 'ERROR';
            $response['messages'] = array(
                $e->getMessage(),
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route(
     *      "/{activityId}",
     *      name    = "innova_activity_update",
     *      options = { "expose" = true }
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
        $form = $this->formFactory->create('innova_activity', $activity, $params);

        $response = array();

        // Try to process data
        $this->activityHandler->setForm($form);
        if ($this->activityHandler->process()) {
            // Add user message
            /*$this->session->getFlashBag()->add(
                'success', $this->translator->trans('path_save_success', array(), 'path_editor')
            );*/
            $response['status'] = 'OK';
            $response['data']   = $this->activityHandler->getData();
        } else {
            // Error
            // List des erreurs symfony (FormError...)
            /*$errors = $form->getErrors();*/

            $response['status'] = 'ERROR_VALIDATION';
            $errors = $this->getFormErrors($form);

            // SI non fonctionnel du premier coup alors :
            // - pour chaque champ, 'nom_du_champ' => 'message'

            // ATTENTION : le nom du champ doit valoir nom_form_type + nom_du_champ (ex. innova_activity_type_name)
            // Fait.


            // // - boucler sur les erreurs Symfony
            // foreach ($form->getErrors() as $key => $error) {
            //     $errors[] = $error->getMessage();
            // }

            $response['messages'] = array(
                $errors,
            );
        }

        // TODO : return soit l'entity mise à jour soit un message erreurs (erreurs de validation de form)
        return new JsonResponse($response);
    }

    /**
     * @Route(
     *      "/{activityId}",
     *      name    = "innova_activity_delete",
     *      options = { "expose" = true }
     * )
     * @ParamConverter("activity", class="InnovaActivityBundle:Activity", options={"mapping": {"activityId": "id"}})
     * @Method("DELETE")
     */
    public function deleteAction(Activity $activity)
    {
        $deleted = $this->activityManager->delete($activity);

        $response = array(
            'status' => $deleted ? 'OK' : 'ERROR',
            'data' => array(),
        );

        return new JsonResponse($response);
    }

    private function getFormErrors(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $key => $error) {
            $errors[$key] = $error->getMessage();
        }

        // Get errors from children
        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getFormErrors($child);
            }
        }

        return $errors;
    }
}
