<?php
/**
 * DisplayDevicesProcessModel.php
 *
 * @author A Fayers
 * @copyright De Montfort University
 *
 * @package crypto-show
 */

class DisplayDevicesProcessModel extends ModelAbstract
{
    private $device_list;

    public function __construct()
    {
        parent::__construct();
        $this->$device_list = [];
    }

    public function __destruct(){}

    public function setDatabaseHandle($database_handle)
    {
        $this->database_handle = $database_handle;
    }

    public function getDeviceResult()
    {
        return $this->get_devices_result;
    }

    public function setValidatedInput($validated_input)
    {
        $this->get_devices_result = $validated_input;
    }

    private function fetchDeviceList()
    {
        $devices = [];

        $sql_query_parameters = [
            ':usernickname' => $this->get_devices_result['validated-user-nickname']
        ];

        $sql_query_string = SqlQuery::queryFetchUserDetails();
        $query_result = $this->database_handle->safeQuery($sql_query_string, $sql_query_parameters);

        $user_recordset = $this->database_handle->safeFetchArray();

        $user_details['user-id'] = $user_recordset['user_id'];
        $user_details['user-nickname'] = $this->login_user_result['validated-user-nickname'];
        $user_details['user-name'] = $user_recordset['user_name'];
        $user_details['user-email'] = $user_recordset['user_email'];
        $user_details['user-machine-count'] = $user_recordset['user_machine_count'];
        $user_details['user-registered-timestamp'] = $user_recordset['user_registered_timestamp'];

        return $user_details;
    }

    public function updateUserSession($user_login_result)
    {
        $set_session_result = SessionsWrapper::setSession('user-nickname', $user_login_result['user-nickname']);
        $set_session_result = SessionsWrapper::setSession('user-id', $user_login_result['user-id']);
    }
}
