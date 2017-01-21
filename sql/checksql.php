<?php

/* 
 * All rights reserved. Copyright Robert Roy 2016.
 */
include_once 'sqlutil.php';

//This page validates whether or not you can connect to your SQL server
$SQLUtil = new SQLUtil();
if(!$SQLUtil->validConn()){
    echo "You cannot currently connect to your SQL server."; // connection error of some kind
}else{
    echo "You have a connection to your SQL server.";
}