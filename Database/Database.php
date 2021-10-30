<?php

final class Conexao
{

    private $servername = "servername";
    private $username = "username";
    private $password = "password";

    public function conexao()
    {
        $conn = null;
        try {
            $conn = new PDO("mysql:host={$this->servername};dbname=banco", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        } finally {
            if ($conn != null) {
                return $conn;
            } else {
                echo json_encode(["msg" => "não conectado!"], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
