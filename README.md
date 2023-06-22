# Projeto Financeiro

### 1° DS - Turma B

## Integrantes:
Erik Machado Lopez <br/>
Guilherme Cardoso <br/> 
Felipe Martins Frudeli <br/>
João Pedro Prado <br/>
Wendell <br/>


## Como ultilizar:

1. Instale o repositório localmente
2. Entre na pasta
3. Caso não tenha instalado leia  https://dev.to/marcelochia/instalando-o-php-8-no-windows-237m <br/>
ou se estiver instalado WAMP ou XAMPP, pesquise por "Add path php WAMP"
4. Inicie um servidor PHP

```
git clone https://github.com/FelipeMartinsFrudeli/Projeto-Financeiro
cd Projeto-Financeiro/src/public
php -S localhost:8080
```

5. Crie um novo arquivo de mysql e execute o código abaixo:

```sql
DROP DATABASE IF EXISTS Projeto_Financeiro;
CREATE DATABASE Projeto_Financeiro;
USE Projeto_Financeiro;

CREATE TABLE registred_user
(
	user_id 	INT PRIMARY KEY AUTO_INCREMENT,
    first_name	VARCHAR(60) NOT NULL,
    login		VARCHAR(100) NOT NULL,
    pass_word	VARCHAR(100) NOT NULL,
    create_date	DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bank_account 
(
	account_id 	INT PRIMARY KEY AUTO_INCREMENT,
    user_id		INT	NOT NULL,
    amount		DECIMAL(22,2) NOT NULL DEFAULT 0,
    create_date	DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES registred_user(user_id)
);

CREATE TABLE transactions
(
	transaction_id	INT PRIMARY KEY AUTO_INCREMENT,
    account_id		INT NOT NULL,
    amount			DECIMAL(12,2) NOT NULL,
    t_type			VARCHAR(60) NOT NULL,
	title			VARCHAR(100),
    t_description 	TEXT,
    t_date			DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (account_id) REFERENCES bank_account(account_id) ON DELETE CASCADE
);

DELIMITER $
CREATE TRIGGER tgr_transaction 
AFTER INSERT ON transactions 
FOR EACH ROW
BEGIN
	IF NEW.t_type = "Deposit" THEN 
	  UPDATE bank_account SET amount = amount + NEW.amount
		WHERE account_id = NEW.account_id;
	END IF;
    
	IF NEW.t_type = "Withdraw" THEN 
	  UPDATE bank_account SET amount = amount - NEW.amount
		WHERE account_id = NEW.account_id;
	END IF;
END$

CREATE TRIGGER trg_delete_transaction
AFTER DELETE ON transactions
FOR EACH ROW
BEGIN
	IF OLD.t_type = "Deposit" THEN 
	  UPDATE bank_account SET amount = amount - OLD.amount
		WHERE account_id = OLD.account_id;
	END IF;
    
	IF OLD.t_type = "Withdraw" THEN 
	  UPDATE bank_account SET amount = amount + OLD.amount
		WHERE account_id = OLD.account_id;
	END IF;
END$
DELIMITER ;
```
