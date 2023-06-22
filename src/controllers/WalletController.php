<?php

namespace app\controllers;

use app\models\Wallet;
use app\Router;

class WalletController
{
  public static function index(Router $router){
    $account_amount = $router->db->getBankAccountById($_SESSION['user_id']);
    $transactions = $router->db->getTransactionsById($_SESSION['user_id']);

    $router->renderView('wallet/index','wallet', [
        'account' => $account_amount,
        'transactions' => $transactions
    ]);
  }

  private static function setData(Router $router, $type){
    echo 'b';
    $errors = [];
    $transactionData = [
      'account_id'  => '',
      'amount'  =>  '',
      't_type'  =>  '',
      'title'   =>  '',
      't_description' =>  ''
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $transactionData['account_id'] = $_SESSION['user_id'];//$_POST['account_id'];
      $transactionData['amount'] = (float)$_POST['amount'];
      $transactionData['title'] = $_POST['title'];
      $transactionData['t_description'] = $_POST['t_description'];
      $transactionData['t_type'] = $type;
    }

    $wallet = new Wallet();
    $wallet->load($transactionData);
    $errors = $wallet->new_transaction();

    if (empty($errors)) {
      header('Location: /wallet');
      exit;
    }

    header('Location: /wallet');
  }

  public static function deposit(Router $router){
    echo 'a';
    self::setData($router, 'Deposit');
  }
  public static function withdraw(Router $router){
    self::setData($router, 'Withdraw');
  }

  public static function delete(Router $router){
    $id = $_POST['id'] ?? null;
    if (!$id) {
      header('Location: /wallet');
      exit;
    }
    $router->db->deleteTransaction($id);
    header('Location: /wallet');
  }
}