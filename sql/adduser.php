<?php

/*
 * All rights reserved. Copyright Robert Roy 2016.
 */

include_once 'sqlutil.php';

// get SQL connection instance
$SQLUtil = new SQLUtil();

// Sample user info to be added to your database
$email = "test3@test.test";
$password = "password";
$blnAdded = $SQLUtil->addUser($email, $password);
if ($blnAdded) {
    echo "User added";
} else {
    echo "User not added";
}
?>