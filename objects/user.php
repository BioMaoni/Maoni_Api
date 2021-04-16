<?php
class User
{

    private $conn;
    //private $table_name = "user";

    public $id;
    public $email;
    public $name;
    public $surname;
    public $company;
    public $country;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function login()
    {
        $stmt = $this->conn->prepare("SELECT ID, name FROM user WHERE email= :email AND password= :password");
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR, 12);
        $stmt->bindParam(':password', $this->password, PDO::PARAM_STR, 12);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        if ($this->isAlreadyExist()) {
            return false;
        }

        $stmt = $this->conn->prepare("INSERT INTO user(`name`, `surname`, `email`, `password`, `country`) VALUES (:name, :surname, :email, :password, :country)");
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR, 12);
        $stmt->bindParam(':surname', $this->surname, PDO::PARAM_STR, 12);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR, 12);
        $stmt->bindParam(':password', $this->password, PDO::PARAM_STR, 12);
        $stmt->bindParam(':country', $this->country, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    function read()
    {
        $stmt = $this->conn->prepare("SELECT * FROM user ORDER BY id DESC");
        $stmt->execute();
        return $stmt;
    }

    function delete()
    {
        $stmt = $this->conn->prepare("DELETE FROM user WHERE ID = :ID");
        $stmt->bindParam(':ID', $this->id, PDO::PARAM_INT);
        //Sempre retorna true
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function isAlreadyExist()
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR, 12);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
