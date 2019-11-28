<?php
/**
 * UserLoginFormController.php
 *
 * Sessions: PHP web application to demonstrate how databases
 * are accessed securely
 *
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 *
 * @package crypto-show
 */

class AddDeviceFormController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $view = Factory::buildObject('AddDeviceFormView');
        $view->createAddDeviceForm();
        $this->html_output = $view->getHtmlOutput();
    }
}
