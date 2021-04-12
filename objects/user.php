<?php
class User
{
    //We need to create the entirely CRUD (create_user, delete_user, read_user_single, read_user, update_user)

    // database connection and table name
    private $conn;
    private $table_name = "";

    // object properties
    public $id;
    public $username;
    public $password;
    public $created;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // signup user
    function signup()
    {
        if ($this->isAlreadyExist()) {
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    username=:username, password=:password, created=:created";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->created = htmlspecialchars(strip_tags($this->created));
        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":created", $this->created);
        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // login user
    function login()
    {
        // select all query
        $query = "SELECT
        `id`, `username`, `password`, `created`
        FROM
            " . $this->table_name . " 
        WHERE
            username='" . $this->username . "' AND password='" . $this->password . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // read all doctors
    function read()
    {

        // select all query
        $query = "SELECT
                    `id`, `name`, `email`, `password`, `phone`, `gender`, `specialist`, `created`
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    // get single doctor data
    function read_single()
    {

        // select all query
        $query = "SELECT
                    `id`, `name`, `email`, `password`, `phone`, `gender`, `specialist`, `created`
                FROM
                    " . $this->table_name . " 
                WHERE
                    id= '" . $this->id . "'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        return $stmt;
    }
    // create doctor
    function create()
    {

        if ($this->isAlreadyExist()) {
            return false;
        }

        // query to insert record
        $query = "INSERT INTO  " . $this->table_name . " 
                        (`name`, `email`, `password`, `phone`, `gender`, `specialist`, `created`)
                  VALUES
                        ('" . $this->name . "', '" . $this->email . "', '" . $this->password . "', '" . $this->phone . "', '" . $this->gender . "', '" . $this->specialist . "', '" . $this->created . "')";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    // update doctor 
    function update()
    {

        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='" . $this->name . "', email='" . $this->email . "', password='" . $this->password . "', phone='" . $this->phone . "', gender='" . $this->gender . "', specialist='" . $this->specialist . "'
                WHERE
                    id='" . $this->id . "'";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // delete doctor
    function delete()
    {

        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    id= '" . $this->id . "'";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // a function to check if username already exists
    function isAlreadyExist()
    {
        $query = "SELECT *
        FROM
            " . $this->table_name . " 
        WHERE
            username='" . $this->username . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
