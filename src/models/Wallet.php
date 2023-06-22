<?php


namespace app\models;

use app\Database;

use function PHPSTORM_META\type;

class Wallet
{
  public ?int $account_id = null;
  public ?float $amount = null;
  public ?string $t_type = null;
  public ?string $title = null;
  public ?string $t_description = null;

  public function load($data)
  {
    $this->account_id = $data['account_id'];
    $this->amount = $data['amount'];
    $this->t_type = $data['t_type'];
    $this->title = $data['title'];
    $this->t_description = $data['t_description'];
  }

  public function new_transaction()
  {
    $errors = [];
    if (!$this->account_id) { $errors[] = 'O numero da conta e nescessario!'; };
    if (!$this->title) { $errors[] = 'O titulo e nescessario!'; };
    if (!$this->t_type) { $errors[] = 'O tipo e nescessario!'; };
    if (!$this->amount) { $errors[] = 'A quantidade e nescessaria!'; };

    $db = Database::$db;
    if (empty($errors)) {
      $db->query('INSERT INTO transactions (account_id, amount, t_type, title, t_description) 
        VALUES (:account_id, :amount, :t_type, :title, :t_description);');

      $db->bind(':account_id', $this->account_id);
      $db->bind(':amount', $this->amount);
      $db->bind(':title', $this->title);
      $db->bind(':t_type', $this->t_type);
      $db->bind(':t_description', $this->t_description);
      $db->execute();
    }

    return $errors;
  }
}