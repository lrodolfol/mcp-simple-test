<?php

use App\Controllers\UserController;
use App\Entities\User;

require 'vendor/autoload.php';


// Headers para API
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Inicializando o router
$router = new \Bramus\Router\Router();

// Definindo as rotas da API
$router->get('/', function() {
    echo json_encode(['mensagem' => 'Bem-vindo à API simples']);
});

// Rotas para usuários
$router->mount('/api/users', function() use ($router) {

    $router->post('/', function () {
        $controller = new App\Controllers\UserController();
        $controller->create();
    });

    $router->get('/', function() {
        $controller = new \App\Controllers\UserController();
        $controller->getAll();
    });
    
    // Obter um usuário específico
    $router->get('/{id}', function($id) {
        $controller = new \App\Controllers\UserController();
        $controller->getById($id);
    });

    $router->delete('/{id}', function($id) {
        $controller = new UserController();
        $controller->delete($id);
    });
});

// Iniciar o router
$router->run();