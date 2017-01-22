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

    public function addUser($email, $password) {
        //Returns true, if success or false if failed
        try {
            // # of users with given email
            $statement4 = $this->Conn->prepare("SELECT COUNT(*) FROM users WHERE email = (?)");
            $statement4->execute([$email]);
            $count = $statement4->fetch(PDO::FETCH_NUM)[0];
            // Only want to add users if email is unique. Two users CANNOT have one email
            if ($count === "0") {
                // add user to users table
                $statement = $this->Conn->prepare("INSERT INTO users (email) VALUES (?)");
                $statement->execute([$email]);
                // get userid from users table
                $statement2 = $this->Conn->prepare("SELECT * FROM users WHERE email = ?");
                $statement2->execute([$email]);
                $row = $statement2->fetch(PDO::FETCH_ASSOC);
                $userid = $row['userid'];
                // turn raw password into securely hashed password
                $salthash = password_hash($password, PASSWORD_DEFAULT);
                // insert into passwords table with correlating userid
                $statement3 = $this->Conn->prepare("INSERT INTO passwords VALUES (?, ?)");
                $statement3->execute([$userid, $salthash]);
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return false;
        }
    }

    public function tryLogin($email, $password) {
        // returns 
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
                if ($blnValid) {
                    return $userid;
                }else{
                    return false;
                }
            } else if ($count !== "0") {
                return -1;
            } else {
                return -1;
            }
        } catch (Exception $ex) {
            //This should be logged
        }
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

    public function validConn() {
        if ($this->Conn === false) {
            return false;
        } else {
            return true;
        }
    }

}

?>