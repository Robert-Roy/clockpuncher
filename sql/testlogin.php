<?php

/*
 * All rights reserved. Copyright Robert Roy 2016.
 */

include_once 'sqlconnector.php';

$SQLConn = new SQLConnector();
$Conn = $SQLConn->getConn();

//Sample user login to try
$email = "test2@test.test";
$password = "password";
try {
    //Check if email exists in users table, respond accordingly
    $statement4 = $Conn->prepare("SELECT COUNT(*) FROM users WHERE email = (?)");
    $statement4->execute([$email]);
    $count = $statement4->fetch(PDO::FETCH_NUM)[0];
    if ($count === "1") {
        // get userid associated with email
        $statement2 = $Conn->prepare("SELECT userid FROM users WHERE email = ?");
        $statement2->execute([$email]);
        $userid = $statement2->fetch(PDO::FETCH_NUM)[0];
        //get hashed pw associated with userid
        $statement3 = $Conn->prepare("SELECT password FROM passwords WHERE userid = ?");
        $statement3->execute([$userid]);
        $salthash = $statement3->fetch(PDO::FETCH_NUM)[0];
        //check that unhashed password matches hashed pw
        $blnValid = password_verify($password, $salthash);
        if($blnValid){
            echo "Valid login";
        }else{
            echo "Invalid login";
        }
    } else if ($count !== "0") {
        // The count should be 1 or 0. Anything else is very bad
        echo "Something very, very wrong has happened";
    } else {
        "Invalid email";
    }
} catch (Exception $ex) {
    echo $ex;
}
?>
