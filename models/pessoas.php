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
        $db  = DatabaseConnection::getInstance();
        $pdo = $db->getConnection();
        $sql = 'SELECT p.*,
                          fa.descricao as formacao_academica_descricao,
                          e.cep,
                          e.logradouro,
                          e.complemento,
                          e.bairro,
                          e.localidade,
                          e.uf
                    FROM pessoas as p
                    LEFT JOIN formacao_academicas fa on(fa.id=p.formacao_academica_id)
                    LEFT JOIN enderecos e on(e.id=p.endereco_id)
                   ';
        if(!empty($search)){
            $s    = strtolower($search);
            $sql .= " WHERE LOWER(p.nome) like '%$s%' ";
        }
  
        $stmt 	= $pdo->prepare($sql.$limit);
        $stmt->execute();
        return $stmt;
    }

    public static function find($id) {
        $db     = DatabaseConnection::getInstance();
        $pdo    = $db->getConnection();

        $sql 	= 'SELECT p.*,
                          fa.descricao as formacao_academica_descricao,
                          e.cep,
                          e.logradouro,
                          e.complemento,
                          e.bairro,
                          e.localidade,
                          e.uf
                    FROM pessoas as p
                    LEFT JOIN formacao_academicas fa on(fa.id=p.formacao_academica_id)
                    LEFT JOIN enderecos e on(e.id=p.endereco_id)
                    WHERE p.id='.$id;
        $stmt 	= $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public static function create($data){
        try{
            $db = DatabaseConnection::getInstance();
            $pdo = $db->getConnection();

            //insert endereços
            $endereco = $pdo->prepare("insert into enderecos values(null,
                                    :logradouro, :complemento, :bairro, :localidade, :uf, :cep)");
            $endereco->bindParam(':logradouro',  $data['logradouro']);
            $endereco->bindParam(':complemento',  $data['complemento']);
            $endereco->bindParam(':bairro',  $data['bairro']);
            $endereco->bindParam(':localidade',  $data['localidade']);
            $endereco->bindParam(':uf',  $data['uf']);
            $endereco->bindParam(':cep',  $data['cep']);
            $endereco->execute();
            $endereco_id = $pdo->lastInsertId();

            //insert pessoas
            $stmt = $pdo->prepare("insert into pessoas values(null,
                                    :nome, :idade, :telefone, :pretensao_salarial, :formacao_academica_id, :endereco_id)");
            $stmt->bindParam(':nome',  $data['nome']);
            $stmt->bindParam(':idade',  $data['idade']);
            $stmt->bindParam(':telefone',  $data['telefone']);
            $stmt->bindParam(':pretensao_salarial',  $data['pretensao_salarial']);
            $stmt->bindParam(':formacao_academica_id',  $data['formacao_academica_id']);
            $stmt->bindParam(':endereco_id', $endereco_id);
            $result = $stmt->execute();
            
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

            //save pessoa
            $stmt = $pdo->prepare("UPDATE pessoas SET nome=:nome, idade=:idade, telefone=:telefone, pretensao_salarial=:pretensao_salarial, formacao_academica_id=:formacao_academica_id WHERE id=:id;");
            $stmt->bindParam(':nome',  $data['nome']);
            $stmt->bindParam(':idade',  $data['idade']);
            $stmt->bindParam(':telefone',  $data['telefone']);
            $stmt->bindParam(':pretensao_salarial',  $data['pretensao_salarial']);
            $stmt->bindParam(':formacao_academica_id',  $data['formacao_academica_id']);
            $stmt->bindParam(':id',  $id);
            $stmt->execute();

            //save endereco
            $endereco = $pdo->prepare("UPDATE enderecos SET logradouro=:logradouro, complemento=:complemento, bairro=:bairro, localidade=:localidade, uf=:uf, cep=:cep WHERE id=:id;");
            $endereco->bindParam(':logradouro',  $data['logradouro']);
            $endereco->bindParam(':complemento',  $data['complemento']);
            $endereco->bindParam(':bairro',  $data['bairro']);
            $endereco->bindParam(':localidade',  $data['localidade']);
            $endereco->bindParam(':uf',  $data['uf']);
            $endereco->bindParam(':cep',  $data['cep']);
            $endereco->bindParam(':id',  $data['endereco_id']);
            $endereco->execute();

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

    public static function getFormacaoAcademicaReport()
    {
        $db  = DatabaseConnection::getInstance();
        $pdo = $db->getConnection();
        $sql = 'select
                    count(formacao_academica_id) as total,
                    fa.descricao
                from pessoas p
                left join formacao_academicas as fa on(fa.id=p.formacao_academica_id)

                WHERE formacao_academica_id is not null
                group by p.formacao_academica_id
                order by total desc;';
        
  
        $stmt   = $pdo->prepare($sql);
        $stmt->execute();
        $rows = [];

        // wasn't used json_enconde because the conversion needed to be a integer not a string
        while ($row = $stmt->fetch()){
            $rows[] = "['".utf8_encode($row['descricao']) . "', " . utf8_encode($row['total'])."]";
        }
        return "[".implode(',', $rows)."]";
    }

    public static function getFaixaEtariaReport()
    {
        $db  = DatabaseConnection::getInstance();
        $pdo = $db->getConnection();
        $sql = 'select
                id,
                descricao,
                (select count(*) from pessoas where idade BETWEEN 18 and 25 and fa.id=formacao_academica_id) as total_18_25,
                (select count(*) from pessoas where idade BETWEEN 26 and 35 and fa.id=formacao_academica_id) as total_26_35,
                (select count(*) from pessoas where idade BETWEEN 36 and 45 and fa.id=formacao_academica_id) as total_36_45
            from formacao_academicas fa';
        
  
        $stmt   = $pdo->prepare($sql);
        $stmt->execute();
        $rows = [];

        // wasn't used json_enconde because the conversion needed to be a integer not a string
        while ($row = $stmt->fetch()){
            $rows[] = "['".utf8_encode($row['descricao']) . "', " . $row['total_18_25'] .", ".$row['total_26_35'] .",". $row['total_36_45']. "]";
        }

        $result = "[['Formação Academica', 'Entre 18-25 anos', 'Entre 26-35 anos', 'Entre 36-45 anos'],";
        $result .= implode(',', $rows)."]";
    
        return $result;
    }
}
