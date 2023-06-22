<?php

namespace app\models;

use app\Database;

use function PHPSTORM_META\type;

class Login
{
	public ?string $login = '';
	public ?string $pass_word = '';

	public function load($data)
	{
		$this->login = $data['login'];
		$this->pass_word = $data['pass_word'];
	}

	public function checkLogin()
	{
	    $errors = [];
	    if (!$this->login) { $errors[] = 'O login e nescessario!'; };
	    if (!$this->pass_word) { $errors[] = 'A senha e nescessaria!'; };
	    
	    $db = Database::$db;
    	if (empty($errors)) {
    		$db->query('SELECT * FROM registred_user WHERE 
    			login = :login AND pass_word = :pass_word;');

    		$db->bind(':login', $this->login);
    		$db->bind(':pass_word', $this->pass_word);
    	}

    	return $errors;
	}
}