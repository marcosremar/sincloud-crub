<?php
class Pessoas {
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $id;
    public $nome;
    public $estado_civil_id;
    public $genero_id;

    public function __construct() {
    }

    public static function all($search, $limit) {
        $db = DatabaseConnection::getInstance();
        $pdo = $db->getConnection();

        $sql 	= 'SELECT p.*,
                          ec.descricao as estado_civil,
                          g.descricao as genero
                    FROM pessoas as p
                    INNER JOIN estado_civil ec on(ec.id=p.estado_civil_id)
                    INNER JOIN genero g on(g.id=p.genero_id)';
        if(!empty($search)){
            $s    = strtolower($search);
            $sql .= " WHERE LOWER(p.nome) like '%$s%' OR
                           LOWER(g.descricao) like '%$s%' OR
                           LOWER(ec.descricao) like '%$s%'";
        }
        $stmt 	= $pdo->prepare($sql.$limit);
        $stmt->execute();
        return $stmt;
    }

    public static function find($id) {
        $db = DatabaseConnection::getInstance();
        $pdo = $db->getConnection();

        $sql 	= 'SELECT p.*
                    FROM pessoas as p
                    WHERE p.id='.$id;
        $stmt 	= $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();

    //   $db = Db::getInstance();
    //   // we make sure $id is an integer
    //   $id = intval($id);
    //   $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
    //   // the query was prepared, now we replace :id with our actual $id value
    //   $req->execute(array('id' => $id));
    //   $post = $req->fetch();
      //
    //   return new Post($post['id'], $post['author'], $post['content']);
    }
    public static function create($data){
        try{
            $db = DatabaseConnection::getInstance();
            $pdo = $db->getConnection();

            $stmt = $pdo->prepare("insert into pessoas values(null,
                                    :nome, :estado_civil_id, :genero_id)");
            $stmt->bindParam(':nome',  $data['nome']);
            $stmt->bindParam(':estado_civil_id',  $data['estado_civil_id']);
            $stmt->bindParam(':genero_id',  $data['genero_id']);
            $stmt->execute();

            return true;
        }
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public static function update($id, $data){
        try{
            $db = DatabaseConnection::getInstance();
            $pdo = $db->getConnection();

            $stmt = $pdo->prepare("UPDATE pessoas SET nome=:nome, estado_civil_id=:estado_civil_id, genero_id=:genero_id WHERE id=:id;");
            $stmt->bindParam(':nome',  $data['nome']);
            $stmt->bindParam(':estado_civil_id',  $data['estado_civil_id']);
            $stmt->bindParam(':genero_id',  $data['genero_id']);
            $stmt->bindParam(':id',  $id);
            $stmt->execute();
            return true;
        }
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
    public static function delete($id){
        try{
            $db = DatabaseConnection::getInstance();
            $pdo = $db->getConnection();

            $stmt = $pdo->prepare("DELETE FROM pessoas WHERE id=:id;");
            $stmt->bindParam(':id',  $id);
            $stmt->execute();
            return true;
        }
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
}
