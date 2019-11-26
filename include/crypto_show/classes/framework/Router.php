<?php
/**
 * Router.php
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 *
 * @package crypto-show
 */

class Router
{
    private $html_output;

    public function __construct()
    {
        $this->html_output = '';
    }

    public function __destruct(){}

    public function routing()
    {
        $html_output = '';

        $selected_route = $this->setRouteName();
        $route_exists = $this->validateRouteName($selected_route);

        if ($route_exists == true)
        {
            $html_output = $this->selectController($selected_route);
        }
        $this->html_output = $this->processOutput($html_output);
    }

    /**
     * Set the default route to be index
     *
     * Read the name of the selected route from the magic global POST array and overwrite the default if necessary
     *
     * @return mixed|string
     */

    private function setRouteName(): string
    {
        $selected_route = 'index';
        if (isset($_POST['route']))
        {
            $selected_route = $_POST['route'];
        }

        return $selected_route;
    }
    /**
     * Check to see that the route name passed from the client is valid.
     * If not valid, chances are that a user is attempting something malicious.
     * In which case, kill the app's execution.
     */
    private function validateRouteName($selected_route): bool
    {
        $route_exists = false;
        $validate = Factory::buildObject('Validate');
        $route_exists = $validate->validateRoute($selected_route);
        return $route_exists;
    }

    public function selectController(string $selected_route): string
    {
        switch ($selected_route)
        {
            case 'user_register':
                $controller = Factory::buildObject('UserRegisterFormController');
                break;
            case 'process_new_user_details':
                $controller = Factory::buildObject('UserRegisterProcessController');
                break;
            case 'user_login':
                $controller = Factory::buildObject('UserLoginFormController');
                break;
            case 'process_login':
                $controller = Factory::buildObject('UserLoginProcessController');
                break;
            case 'user_logout':
                $controller = Factory::buildObject('UserLogoutProcessController');
                break;
            case 'display-crypto-details':
                $controller = Factory::buildObject('DisplayCryptoDetailsController');
                break;
            case 'route-error':
                $controller = Factory::buildObject('ErrorController');
                $controller->setErrorType('route-not-found-error');
                break;
            case 'index':
            default:
            $controller = Factory::buildObject('IndexController');
                break;
        }
        $controller->createHtmlOutput();
        $html_output = $controller->getHtmlOutput();
        return $html_output;
    }

    private function processOutput(string $html_output)
    {
        $processed_html_output = '';
        $process_output = Factory::buildObject('ProcessOutput');
        $processed_html_output = $process_output->assembleOutput($html_output);
        return $processed_html_output;
    }

    public function getHtmlOutput()
    {
        return $this->html_output;
    }
}
