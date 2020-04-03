<?php
/**
 * Класс для работы с базой данных mydb
 */
require_once("php/model/Database.php");

class MyDatabase extends Database
{
    // Подключаемся к базе данных
    function __construct($sHost = "localhost", $sUser = "root", $sPassword = "")
    {
        parent::__construct("test_db", $sHost, $sUser, $sPassword);
    }

    /**
     *    Метод заполняет поле в таблице users регистрационными данными из aParams
     *    aParams - ассоциативный массив с регистрационными данными
     *    ключи - соответствуют названиям столбцов в тблице
     */
    public function insert($aParams)
    {
        try {
            $oStmt = $this->oDB->prepare("INSERT INTO users (name, email, password, birth_date, photo, gender)
											VALUES ( :name, :email, :password, :birth_date, :photo, :gender );");
            $oStmt->bindParam(":name", $aParams['name']);
            $oStmt->bindParam(":email", $aParams['email']);
            $oStmt->bindParam(":password", $aParams['password']);
            $sBirthDate = intval($aParams['birth_year']) . "-" . intval($aParams['birth_month']) . "-" . intval($aParams['birth_day']);
            $oStmt->bindParam(":birth_date", $sBirthDate);
            $oStmt->bindParam(":photo", $aParams['photo']);
            $gender = ($aParams['gender']) ? 'male' : 'female';
            $oStmt->bindParam(":gender", $gender);

            $oStmt->execute();
        } catch (PDOException $e) {
            $this->log($e->getMessage());
        }
    }

    /**
     * Метод возвращает по id пользователя имя, дату рождения, пол, адрес, фото пользователя
     * в виде ассоциативного массива
     */
    public function getField($id)
    {
        try {
            $oStmt = $this->oDB->prepare("	SELECT 	users.name as name,
														users.birth_date as birth_date,
														users.gender as gender,
														users.photo as photo
												FROM 	users 
												WHERE users.id = :id;");
            $oStmt->bindParam(":id", intval($id));
            $oStmt->execute();
            return $oStmt->fetch();
        } catch (PDOException $e) {
            $this->log($e->getMessage());
        }
    }

    /**
     *    Метода проверяет есть ли в таблице users пользователь с почтой sEmail
     */
    public function getEmail($sEmail)
    {
        try {
            $oStmt = $this->oDB->prepare("SELECT users.email as email FROM users WHERE users.email = :email");
            $oStmt->bindParam(":email", $sEmail);
            $oStmt->execute();
            return $oStmt->fetchColumn();
        } catch (PDOException $e) {
            $this->log($e->getMessage());
        }
    }

    /**
     *    Метод возвращает ИД пользователя по email
     */
    public function getId($sEmail)
    {
        try {
            $oStmt = $this->oDB->prepare("SELECT users.id as email FROM users WHERE users.email = :email");
            $oStmt->bindParam(":email", $sEmail);
            $oStmt->execute();
            return $oStmt->fetchColumn();
        } catch (PDOException $e) {
            $this->log($e->getMessage());
        }
    }


    /**
     *    Метод возвращает почту, пароль и ИД пользователя из таблицы users
     */
    public function getAuthData($sEmail)
    {
        try {
            $oStmt = $this->oDB->prepare("SELECT email, password, id FROM users WHERE `email` = :email");
            $oStmt->bindParam(":email", $sEmail);
            $oStmt->execute();
            return $oStmt->fetch();
        } catch (PDOException $e) {
            $this->log($e->getMessage());
        }
    }
}

?>