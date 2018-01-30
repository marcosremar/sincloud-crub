<?php
class FormacaoAcademica
{
    public $id;
    public $descricao;

    public static function all()
    {

        $db  = DatabaseConnection::getInstance();
        $pdo = $db->getConnection();

        $sql 	= 'SELECT * FROM formacao_academicas';
        $stmt   = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
