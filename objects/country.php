<?php
class Country{
    
    private $table_name = "country";
    private $conn;

    private $id;
    private $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
}