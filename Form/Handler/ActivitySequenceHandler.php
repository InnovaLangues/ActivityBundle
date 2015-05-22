<?php

namespace Innova\ActivityBundle\Form\Handler;

use Innova\ActivityBundle\Manager\ActivitySequenceManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handles activity form
 *
 */
class ActivitySequenceHandler
{
    /**
     * Current data of the form
     * @var \Innova\ActivityBundle\Entity\ActivitySequence
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
     * Activity manager
     * @var \Innova\ActivityBundle\Manager\ActivitySequenceManager
     */
    protected $activitySequenceManager;

    /**
     * Class constructor
     * @param \Innova\ActivityBundle\Manager\ActivitySequenceManager $activitySequenceManager
     */
    public function __construct(ActivitySequenceManager $activitySequenceManager)
    {
        $this->activitySequenceManager = $activitySequenceManager;
    }

    /**
     * Set current request
     * @param  \Symfony\Component\HttpFoundation\Request           $request
     * @return \Innova\ActivityBundle\Form\Handler\ActivitySequenceHandler
     */
    public function setRequest(Request $request = null)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get current data of the form
     * @return \Innova\ActivityBundle\Entity\ActivitySequence
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set current form
     * @param  \Symfony\Component\Form\FormInterface               $form
     * @return \Innova\ActivityBundle\Form\Handler\ActivitySequenceHandler
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
            
            if ($this->form->isValid()) {
                // Form is valid => create or update the activity
                $this->data = $this->form->getData();
                
                if ($this->request->getMethod() == 'POST') {
                    // Create activity
                    $success = $this->create();
                } else {
                    // Edit existing activity
                    $success = $this->edit();
                }
            }
        }

        return $success;
    }

    public function create()
    {
        $this->activitySequenceManager->create($this->data);

        return true;
    }

    public function edit()
    {
        $this->activitySequenceManager->edit($this->data);

        return true;
    }
}
