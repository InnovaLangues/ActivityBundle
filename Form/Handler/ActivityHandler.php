<?php

namespace Innova\ActivityBundle\Form\Handler;

use Innova\ActivityBundle\Manager\PathManager;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handles path form
 *
 * @DI\Service("innova.form.handler.activity_handler")
 */
class ActivityHandler
{
    /**
     * Current data of the form
     * @var \Innova\ActivityBundle\Entity\Path\AbstractPath
     * @todo mettre les bons types
     */
    protected $data;

    /**
     * Form to handle
     * @var \Symfony\Component\Form\Form
     */
    protected $form;

    /**
     * Current request
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * Path manager
     * @var \Innova\ActivityBundle\Manager\PathManager
     */
    protected $pathManager; // TODO : remplacer le bon manager (ActivityManager)

    /**
     * Class constructor
     * @param \Innova\ActivityBundle\Manager\PathManager $pathManager
     */
    public function __construct(PathManager $pathManager)
    {
        // TODO : injecter le bon manager
        $this->pathManager = $pathManager;
    }

    /**
     * Set current request
     * @param  \Symfony\Component\HttpFoundation\Request   $request
     * @return \Innova\ActivityBundle\Form\Handler\PathHandler
     */
    public function setRequest(Request $request = null)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get current data of the form
     * @return \Innova\ActivityBundle\Entity\Path\AbstractPath
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set current form
     * @param  \Symfony\Component\Form\FormInterface $form
     * @return \Innova\ActivityBundle\Form\Handler\PathHandler
     */
    public function setForm(FormInterface $form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Process current form
     * @return boolean
     */
    public function process()
    {
        $success = false;
        if ($this->request->getMethod() == 'POST' || $this->request->getMethod() == 'PUT') {
            // Correct HTTP method => try to process form
            $this->form->submit($this->request);

            if ( $this->form->isValid() ) {
                // Form is valid => create or update the path
                $this->data = $this->form->getData();

                if ($this->request->getMethod() == 'POST') {
                    // Create path
                    $success = $this->create();
                }
                else {
                    // Edit existing path
                    $success = $this->edit();
                }
            }
        }

        return $success;
    }

    public function create()
    {
        // TODO

        // Retrieve current Workspace
        $workspaceId = $this->request->get('workspaceId');
        $workspace = $this->pathManager->getWorkspace($workspaceId);

        $this->pathManager->create($this->data, $workspace);

        return true;
    }

    public function edit()
    {
        // TODO
        $this->pathManager->edit($this->data);

        return true;
    }
}