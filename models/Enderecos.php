<?php
class Enderecos
{
    public $id;
    public $logradouro;
    public $complemento;
    public $bairro;
    public $localidade;
    public $uf;
    public $cep;

    public static function all()
    {
        $db  = DatabaseConnection::getInstance();
        $pdo = $db->getConnection();

        $sql 	= 'SELECT * FROM enderecos';
        $stmt   = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
