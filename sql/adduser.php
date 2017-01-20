<?php

/*
 * All rights reserved. Copyright Robert Roy 2016.
 */

include_once 'sqlconnector.php';

$SQLConn = new SQLConnector();
$Conn = $SQLConn->getConn();
//Initialize SQL Tables
$email = "test2@test.test";
$password = "password";
try {
    $statement4 = $Conn->prepare("SELECT COUNT(*) FROM users WHERE email = (?)");
    $statement4->execute([$email]);
    $count = $statement4->fetch(PDO::FETCH_NUM)[0];
    if ($count === "0") {
        $statement = $Conn->prepare("INSERT INTO users (email) VALUES (?)");
        $statement->execute([$email]);
        $statement2 = $Conn->prepare("SELECT * FROM users WHERE email = ?");
        $statement2->execute([$email]);
        $row = $statement2->fetch(PDO::FETCH_ASSOC);
        $userid = $row['userid'];
        $salthash = password_hash($password, PASSWORD_DEFAULT);
        $statement3 = $Conn->prepare("INSERT INTO passwords VALUES (?, ?)");
        $statement3->execute([$userid, $salthash]);
        echo "User Created";
    }else{
        echo "Not a unique email";
    }
} catch (Exception $ex) {
    //Do nothing
    echo $ex;
}
?>