<?php

/*
 * All rights reserved. Copyright Robert Roy 2016.
 */

include_once 'sqlutil.php';

$SQLUtil = new SQLUtil();

//Sample user login to try
$email = "test@test.test";
$password = "password";
if($SQLUtil->isValidLogin($email, $password)){
    echo "Valid login.";
}else{
    echo "Invalid login.";
}
?>