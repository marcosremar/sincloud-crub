<?php
class Generos {
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $id;
    public $descricao;

    public function __construct() {
    }

    public static function all() {

        $db = DatabaseConnection::getInstance();
        $pdo = $db->getConnection();

        $sql 	      = 'SELECT * FROM genero';
        $stmt   = $pdo->prepare($sql); // Prevent MySQl injection. $stmt means statement
        $stmt->execute();
        return $stmt;
    }
}
