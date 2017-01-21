<?php

/*
 * All rights reserved. Copyright Robert Roy 2016.
 */

include_once 'sqlconnector.php';

class SQLUtil {

    private $Conn;

    public function __construct() {
        $SQLConn = new SQLConnector();
        $this->Conn = $SQLConn->getConn();
    }

    public function isValidLogin($email, $password) {
        try {
            //Check if email exists in users table, respond accordingly
            $statement4 = $this->Conn->prepare("SELECT COUNT(*) FROM users WHERE email = (?)");
            $statement4->execute([$email]);
            $count = $statement4->fetch(PDO::FETCH_NUM)[0];
            if ($count === "1") {
                // get userid associated with email
                $statement2 = $this->Conn->prepare("SELECT userid FROM users WHERE email = ?");
                $statement2->execute([$email]);
                $userid = $statement2->fetch(PDO::FETCH_NUM)[0];
                //get hashed pw associated with userid
                $statement3 = $this->Conn->prepare("SELECT password FROM passwords WHERE userid = ?");
                $statement3->execute([$userid]);
                $salthash = $statement3->fetch(PDO::FETCH_NUM)[0];
                //check that unhashed password matches hashed pw
                $blnValid = password_verify($password, $salthash);
                return $blnValid;
            } else if ($count !== "0") {
                // The count should be 1 or 0. Anything else is very bad
                return false;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            //This should be logged
        }
    }

}
?>