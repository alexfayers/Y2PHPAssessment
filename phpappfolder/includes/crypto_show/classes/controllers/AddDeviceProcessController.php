<?php
/**
 * class.CryptoShowLoginProcessController.php
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

class AddDeviceProcessController extends ControllerAbstract
{
    public function createHtmlOutput()
    {

        $input_error = true;
        $new_device_result = [];

        $validated_input = $this->validate();
        $input_error = $validated_input['input-error'];

        if (!$input_error)
        {
            $login_user_result = $this->AddDevice($validated_input);
        }

        //$this->html_output = $this->createView($add_device_result);

    }

    private function validate()
    {
        $validate = Factory::buildObject('Validate');
        $tainted = $_POST;

        $cleaned['device-name'] = $validate->validateString('new_user_nickname', $tainted, 3, 50);
        $cleaned['device-model'] = $validate->validateString('new_user_nickname', $tainted, 3, 50);
        $cleaned['device-country'] = $validate->validateString('new_user_nickname', $tainted, 3, 20);
        $cleaned['device-description'] = $validate->validateString('new_user_nickname', $tainted, 3, 200);
        $cleaned['input-error'] = $validate->checkForError($cleaned);

        return $cleaned;
    }

    private function adddevice($validated_input)
    {

        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('AddDeviceProcessModel');

        $model->setDatabaseHandle($database);

        $model->setValidatedInput($validated_input);
        $model->processAddDevice();
        $add_device_result = $model->getUserAddDeviceResult();

        return $add_device_result;
    }

    private function createView($add_device_results)
    {
        $view = Factory::buildObject('AddDeviceProcessView');

        $view->setUserAddDeviceResults($add_device_results);
        $view->createOutputPage();
        $html_output = $view->getHtmlOutput();

        return $html_output;
    }

}
