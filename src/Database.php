<?php

namespace app;

use PDO;

class Database
{
  private \PDO $pdo;
  public static Database $db;

  private $statement;
  private $error;

  public function __construct()
  {
      $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=Projeto_Financeiro', 'root', 'felipe');
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$db = $this;
  }

  public function query($sql) {
    $this->statement = $this->pdo->prepare($sql);
  }

  public function bind($param, $value, $type=null)
  {
    /* if(is_null($type)) {
      if (is_int($value)) {$type = PDO::PARAM_INT;};
      if (is_bool($value)) {$type = PDO::PARAM_BOOL;};
      if (is_null($value)) {$type = PDO::PARAM_NULL;};
      if (is_string($value)) {$type = PDO::PARAM_STR;};
    }; */

    $this->statement->bindValue($param, $value);
  }

  public function execute()
  {
    return $this->statement->execute();
  }

  public function resultSet()
  {
    $this->execute();
    return $this->statement->fetchAll(PDO::FETCH_OBJ);
  }

  public function single()
  {
    $this->execute();
    return $this->statement->fetch(PDO::FETCH_OBJ);
  }

  public function rowCount()
  {
    return $this->statement->rowCount();
  }

  public function getBankAccountById($id)
  {
    $this->query("SELECT amount FROM bank_account WHERE account_id = :id;");
    $this->bind(':id',$id);
    $this->execute();
    return $this->single();
  }

  public function getTransactionsById($id)
  {
    $this->query("SELECT * FROM transactions WHERE account_id = :id;");
    $this->bind(':id',$id);
    $this->execute();
    return $this->resultSet();
  }

  public function deleteTransaction($id)
  {
    $this->query("DELETE FROM transactions WHERE transaction_id = :id;");
    $this->bind(':id',$id);
    $this->execute();
  }
}

