<?php
 /**
  * SqlQuery.php
  *
  * @author CF Ingrams - cfi@dmu.ac.uk
  * @copyright De Montfort University
  *
  * @package crypto-show
  */

 class SqlQuery
 {

  public function __construct(){}

  public function __destruct(){}

  public static function queryGetCryptoMachineNames()
  {
   $sql_query_string  = 'SELECT Crypto_name';
   $sql_query_string .= ' FROM Crypto';
   return $sql_query_string;
  }

  public static function queryGetRegisteredUserNames()
  {
   $sql_query_string  = 'SELECT user_name';
   $sql_query_string .= ' FROM registered_user';
   return $sql_query_string;
  }

  public static function queryStoreNewUserDetails()
  {
   $sql_query_string  = 'INSERT INTO registered_user';
   $sql_query_string .= ' SET';
   $sql_query_string .= ' user_nickname = :usernickname,';
   $sql_query_string .= ' user_name = :username,';
   $sql_query_string .= ' user_email = :useremail,';
   $sql_query_string .= ' user_hashed_password = :userhashedpassword,';
   $sql_query_string .= ' user_machine_count = :usermachinecount,';
   $sql_query_string .= ' user_registered_timestamp = :userregisteredtimestamp';
   return $sql_query_string;
  }

  public static function queryAuthenticateUser()
  {
   $sql_query_string  = 'SELECT user_hashed_password';
   $sql_query_string .= ' FROM registered_user';
   $sql_query_string .= ' WHERE user_nickname = :usernickname';
   $sql_query_string .= ' LIMIT 1';
   return $sql_query_string;
  }

  public static function queryFetchUserDetails()
  {
   $sql_query_string  = 'SELECT user_id, user_name, user_email, user_machine_count, user_registered_timestamp';
   $sql_query_string .= ' FROM registered_user';
   $sql_query_string .= ' WHERE user_nickname = :usernickname';
   $sql_query_string .= ' LIMIT 1';
   return $sql_query_string;
  }

  public static function queryGetCryptoMachineDetails()
  {
   $sql_query_string  = 'SELECT Crypto.Crypto_index, Crypto_name, owner_initials, Crypto_type,';
   $sql_query_string .= ' Crypto_sex, Crypto_dob, Crypto_is_alive, Crypto_do_death,';
   $sql_query_string .= ' Crypto_pic_source, Crypto_description';
   $sql_query_string .= ' FROM Crypto, Cryptopics';
   $sql_query_string .= ' WHERE Crypto_name = :Cryptoname';
   $sql_query_string .= ' AND Crypto.Crypto_index = Cryptopics.Crypto_index';
   $sql_query_string .= ' LIMIT 1';
   return $sql_query_string;
  }

  public static function queryLogErrorMessage()
  {
   $sql_query_string  = 'INSERT INTO cryptoshow_error_log';
   $sql_query_string .= ' SET log_message = :logmessage';
   return $sql_query_string;
  }
 }

