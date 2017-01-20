<?php

/* 
 * All rights reserved. Copyright Robert Roy 2016.
 */
include_once 'sqlconnector.php';

$SQLConn = new SQLConnector();
if($SQLConn === false){
    echo "It's broke"; // connection error of some kind
}else{
    echo "Success";
}