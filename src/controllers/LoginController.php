<?php

namespace app\controllers;

use app\models\Login;
use app\Router;

class LoginController
{
  public static function index(Router $router)
  {
    $router->renderView("login/index", "login");
  }

  public static function login(Router $router)
  {
    $loginData = [
      'login' => '',
      'pass_word' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $loginData['login'] = $_POST['login'];
      $loginData['pass_word'] = $_POST['pass_word'];

      $login = new Login();
      $login->load($loginData);
      $errors = $login->checkLogin();

      $new_login = $router->db->single();
      $total = $router->db->rowCount();

      if (empty($errors)) {
        if($total > 0) {

          var_dump($new_login->user_id);

          //if(!isset($_SESSION['login']) || !isset($_SESSION['pass_word'])) {
            $_SESSION['login'] = $loginData['login'];
            $_SESSION['pass_word'] = $loginData['pass_word'];
            $_SESSION['user_id'] = $new_login->user_id;
          //}

          var_dump($_SESSION);

          header('Location: /wallet');
          exit;  
        }
      }

      header('Location: /login');
    }
  }

  public static function signup(Router $router)
  {
    $router->renderView("login/signup", "login");
  }
}