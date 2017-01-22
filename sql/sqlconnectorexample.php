<!DOCTYPE html>
<?php
/*
 * All rights reserved. Copyright Robert Roy 2016.
 */
class SQLConnector {
    private $conn;
    public function getConn(){
        return $this->conn;
    }
    public function __construct() {
        $this->conn = $this->Conn();
    }
    public static function Conn() {
        try {
            $servername = "localhost";
            $username = "XXXXXXXXXXXX";
            $password = "XXXXXXXXXXXX";
            $dbname = "XXXXXXXXXXXXXX";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo $e . "<br>";
        }
    }

}
?>