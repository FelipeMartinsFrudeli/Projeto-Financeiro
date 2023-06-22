<?php

use app\Router;
use app\controllers\LoginController;
use app\controllers\WalletController;

require_once __DIR__."/../../vendor/autoload.php";

if(!isset($_SESSION)) { session_start(); };

$router = new Router();
$router->get('/', [LoginController::class, 'index']);	
$router->get('/login', [LoginController::class, 'index']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/signup', [LoginController::class, 'signup']);


$router->get('/wallet', [WalletController::class, 'index']);
$router->post('/wallet/delete', [WalletController::class, 'delete']);
$router->post('/deposit', [WalletController::class, 'deposit']);
$router->post('/withdraw', [WalletController::class, 'withdraw']);


$router->resolve();