<?php

namespace Innova\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ChoiceType Controller
 * 
 */
class ChoiceTypeController extends Controller
{
    /**
     * @Route(
     *      "/",
     *      name="innova_activity_type_update",
     *      options={"expose" = true}
     * )
     * @Method("GET")
     * 
     * @param \Innova\ActivityBundle\Controller\ActivityType $activityType
     */
    
    public function updateAction(ActivityType $activityType)
    {
        $params = array(
            'method' => 'PUT',
            'csrf_protection' => false,
        );

        // Create form
        $form = $this->formFactory->create('innova_activity_type', $activityType, $params);

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
    
}