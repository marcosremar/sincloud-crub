<?php
class DatabaseConnection {

     private $_connection;
     private static $_instance;

    //  private $_dbhost = "localhost";
    //  private $_dbusername = "id2265652_sincloud";
    //  private $_dbpassword = "123456";
    //  private $_dbdatabase = "id2265652_sincloud";
     private $_dbhost = "127.0.0.1";
     private $_dbusername = "homestead";
     private $_dbpassword = "secret";
     private $_dbdatabase = "sincloud";

     private function __construct() {

        try
        {
        	$this->_connection = new PDO("mysql:host={$this->_dbhost};dbname={$this->_dbdatabase}", $this->_dbusername, $this->_dbpassword);
        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->getMessage();
            exit();
        }
    }

    public static function getInstance() {
        /* If an instance is not created. */
        if(self::$_instance == null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


     /* Prevent object cloning. */
     private function __clone() { }

     /* Get connection. */
     public function getConnection() {
            return $this->_connection;
     }
 }
