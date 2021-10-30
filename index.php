<?php

require __DIR__ . '/Controller/DBActions.php';

$actions = new DBActions();
$request_method = $_SERVER["REQUEST_METHOD"];


switch ($request_method) {

    case 'GET':
        header('Content-Type: application/json; charset=utf-8');
        if (!empty($_GET["id"])) {
            echo $actions->pesquisar($_GET["id"]);
        } else {
            echo $actions->clientes();
        }
        break;

    case 'POST':
        header('Content-Type: application/json; charset=utf-8');
        echo $actions->salvar(file_get_contents('php://input'));
        break;

    case 'PUT':
        header('Content-Type: application/json; charset=utf-8');
        echo $actions->alterar(file_get_contents('php://input'));
        break;

    case 'DELETE':
        header('Content-Type: application/json; charset=utf-8');
        echo $actions->deletar($_GET["id"]);
        break;

    default:
        echo "hello";
        break;
}
// }
