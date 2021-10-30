<?php

require_once  __DIR__ . '/../Database/Database.php';

$db = new Conexao();
$cnx  = $db->conexao();

final class DBActions
{
    public function clientes()
    {
        global $cnx;
        try {
            $pstm = $cnx->query("SELECT * FROM clientes");
            $dados = $pstm->fetchAll(PDO::FETCH_OBJ);
            return json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } catch (PDOException $ex) {
            $erro = array(["erro" => $ex->getMessage()]);
            return json_encode($erro, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
    }

    public function pesquisar($id)
    {
        global $cnx;
        $sql = "SELECT * FROM clientes WHERE id = :id";
        try {
            $pstm = $cnx->prepare($sql);
            $pstm->execute([':id' => $id]);
            $result = $pstm->fetchAll(PDO::FETCH_OBJ);
            $cnx = null;
            return json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } catch (PDOException $ex) {
            $erro = array(["erro" => $ex->getMessage()]);
            return json_encode($erro, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
    }

    public function salvar($objeto)
    {
        global $cnx;
        $dados = json_decode($objeto,JSON_OBJECT_AS_ARRAY);
        $sql = "INSERT INTO clientes (data,nome,telefone,email,cep) VALUES (:data,:nome,:telefone,:email,:cep)";
        try {
            $pstm = $cnx->prepare($sql);
            $pstm->bindParam(":data" , date("d-m-Y"));
            $pstm->bindParam(":nome" , $dados["nome"]);
            $pstm->bindParam(":telefone" , $dados["telefone"]);
            $pstm->bindParam(":email" , $dados["email"]);
            $pstm->bindParam(":cep" , $dados["cep"]);
            $confirm  = $pstm->execute();
            $cnx = null;
            return json_encode(["msg"=>$confirm], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        } catch (PDOException $ex) {
            $erro = array(["erro" => $ex->getMessage()]);
            return json_encode($erro, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
    }
}
