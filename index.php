<?php

require __DIR__ . '/Controller/DBActions.php';

$actions = new DBActions();
$request_method = $_SERVER["REQUEST_METHOD"];


switch ($request_method) {

    case 'GET':
        if (!empty($_GET["id"])) {
           echo $actions->pesquisar($_GET["id"]);
        }else{
           echo $actions->clientes();
        }
        break;

    case 'POST':
        header('Content-Type: application/json; charset=utf-8'); 
        echo $actions->salvar(file_get_contents('php://input'));
        break;

    default:
        echo "hello";
        break;
}
// }
