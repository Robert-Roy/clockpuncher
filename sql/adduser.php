<?php

/*
 * All rights reserved. Copyright Robert Roy 2016.
 */

include_once 'sqlconnector.php';

// get SQL connection instance
$SQLConn = new SQLConnector();
$Conn = $SQLConn->getConn();

// Sample user info to be added to your database
$email = "test2@test.test";
$password = "password";

try {
    // # of users with given email
    $statement4 = $Conn->prepare("SELECT COUNT(*) FROM users WHERE email = (?)");
    $statement4->execute([$email]);
    $count = $statement4->fetch(PDO::FETCH_NUM)[0];
    // Only want to add users if email is unique. Two users CANNOT have one email
    if ($count === "0") {
        // add user to users table
        $statement = $Conn->prepare("INSERT INTO users (email) VALUES (?)");
        $statement->execute([$email]);
        // get userid from users table
        $statement2 = $Conn->prepare("SELECT * FROM users WHERE email = ?");
        $statement2->execute([$email]);
        $row = $statement2->fetch(PDO::FETCH_ASSOC);
        $userid = $row['userid'];
        // turn raw password into securely hashed password
        $salthash = password_hash($password, PASSWORD_DEFAULT);
        // insert into passwords table with correlating userid
        $statement3 = $Conn->prepare("INSERT INTO passwords VALUES (?, ?)");
        $statement3->execute([$userid, $salthash]);
        echo "User Created";
    }else{
        echo "Not a unique email";
    }
} catch (Exception $ex) {
    echo $ex;
}
?>