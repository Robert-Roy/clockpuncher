<?php

/*
 * All rights reserved. Copyright Robert Roy 2016.
 */

include_once 'sqlconnector.php';

$SQLConn = new SQLConnector();
$Conn = $SQLConn->conn;
//Initialize SQL Tables
try {
    $Conn->query("CREATE TABLE passwords ("
            . "userid TEXT, "
            . "hash TEXT, "
            . "salt TEXT "
            . ")");
} catch (Exception $ex) {
    //Do nothing
}
try {
    $Conn->query("CREATE TABLE users ("
            . "userid INT NOT NULL AUTO_INCREMENT, "
            . "email TEXT, "
            . "PRIMARY KEY (userid)"
            . ")");
} catch (Exception $ex) {
    //Do nothing
}
?>