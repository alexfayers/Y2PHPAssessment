<?php
/**
 * DisplayDevicesFormController.php
 *
 * Sessions: PHP web application to demonstrate how databases
 * are accessed securely
 *
 *
 * @author A Fayers
 * @copyright De Montfort University
 *
 * @package crypto-show
 */

class DisplayDevicesFormController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $view = Factory::buildObject('DisplayDevicesFormView');
        $view->createLoginForm();
        $this->html_output = $view->getHtmlOutput();
    }
}
