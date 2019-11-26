<?php
/**
 * Validate.php PHP program to perform simple calculations
 *
 * class to validate & sanitise the user entered values
 * returns an error flag if there was a problem
 *
 * NB the values entered by the user are passed as an array
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 *
 * @package simple_sums
 */

class Validate
{
    public function __construct() {}

    public function __destruct() {}

    /**
     * Check that the route name from the browser is a valid route
     * If it is not, abandon the processing.
     * NB this is not a good way to achieve this error handling.
     *
     * @param $route
     * @return boolean
     */
    public function validateRoute($route)
    {
        $route_exists = false;
        $routes = [
            'index',
            'user_register',
            'process_new_user_details',
            'user_login',
            'process_login',
            'user_logout'
        ];

        if (in_array($route, $routes))
        {
            $route_exists =  true;
        }
        else
        {
            die();
        }
        return $route_exists;
    }

    /**
     * Tests that every character in the entered string is a digit.  If  returns false
     * @param $value
     * @return bool|int
     */
    public function validateInteger(int $value): int
    {
        $sanitised_integer = false;
        if (ctype_digit(($value)))
        {
            $sanitised_integer = (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        }
        return $sanitised_integer;
    }

    public function validateString(string $datum_name, array $tainted, int $min_length, int $max_length)
    {
        $validated_string = false;
        if (!empty($tainted[$datum_name]))
        {
            $string_to_check = $tainted[$datum_name];
            $sanitised_string = filter_var($string_to_check, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
            $sanitised_string_length = strlen($sanitised_string);
            if ($min_length <= $sanitised_string_length && $sanitised_string_length <= $max_length)
            {
                $validated_string = $sanitised_string;
            }
        }
        return $validated_string;
    }

    public function validateEmail($datum_name, $tainted, $datum_name_confirm, $maximum_email_length)
    {
        $minimum_email_length = 0;
        $validated_email_to_return = false;

        if (!empty($tainted[$datum_name]) && !empty($tainted[$datum_name_confirm]))
        {
            $email_to_check = $tainted[$datum_name];
            $email_confirm_to_check = $tainted[$datum_name_confirm];

            $sanitised_email = filter_var($email_to_check, FILTER_SANITIZE_EMAIL);
            $validated_email = filter_var($sanitised_email, FILTER_VALIDATE_EMAIL);

            $validated_email_length = strlen($validated_email);
            if ($minimum_email_length <= $validated_email_length && $validated_email_length <= $maximum_email_length)
            {
                if (strcmp($validated_email, $email_confirm_to_check) == 0)
                {
                    $validated_email_to_return = $sanitised_email;
                }
            }
        }
        return $validated_email_to_return;
    }

    public function checkForError($cleaned)
    {
        $input_error = false;
        foreach ($cleaned as $field_to_check)
        {
            if ($field_to_check === false)
            {
                $input_error = true;
                break;
            }

        }
        return $input_error;
    }

}
