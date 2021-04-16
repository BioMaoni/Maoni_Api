<?php
class User
{

    private $conn;
    private $table_name = "user";

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
        $query = "SELECT
        `ID`, `name`
        FROM
            " . $this->table_name . " 
        WHERE
            email='" . $this->email . "' AND password='" . $this->password . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        if ($this->isAlreadyExist()) {
            return false;
        }

        $query = "INSERT INTO  " . $this->table_name . " 
                        (`name`, `surname`, `email`, `password`, `country`)
                  VALUES
                        ('" . $this->name . "', '" . $this->surname . "', '" . $this->email . "', '" . $this->password . "', '" . $this->country . "')";

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    function read()
    {
        $query = "SELECT * FROM " . $this->table_name . "  ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function delete()
    {
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    ID= '" . $this->id . "'";
        $stmt = $this->conn->prepare($query);
        //Sempre retorna true
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function isAlreadyExist()
    {
        $query = "SELECT *
        FROM
            " . $this->table_name . " 
        WHERE
            email='" . $this->email . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
