<?php 
namespace App\Http\Forms;

class FormSettings extends \SleepingOwl\Admin\Form\FormPanel {

    public function initialize()
    {
        if ($this->initialized) {
            return;
        }

        $this->initialized = true;

        $this->getButtons()->setHtmlAttribute('class', 'panel-footer');

        $this->setHtmlAttribute('class', 'panel panel-default');

        $this->initializeItems();

        $this->getButtons()->setModelConfiguration(
            $this->getModelConfiguration()
        );

        $this->setHtmlAttribute('action', $this->getAction());
        
        $this->setHtmlAttribute('method', 'POST');

        $this->getButtons()->hideSaveAndCloseButton();

        $this->getButtons()->hideSaveAndCreateButton();

        $this->includePackage();

    }
}