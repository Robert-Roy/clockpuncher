<?php

/* 
 * All rights reserved. Copyright Robert Roy 2016.
 */
include_once 'sqlconnector.php';

//This page validates whether or not you can connect to your SQL server
$SQLConn = new SQLConnector();
if($SQLConn === false){
    echo "You cannot currently connect to your SQL server"; // connection error of some kind
}else{
    echo "Success";
}