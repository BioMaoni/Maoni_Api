<?php
require_once "user.class.php";
require_once "Connect.php";
class UserDB{
    public function createUser($name, $surname, $email, $country, $password){
        $connection = new Connection();
        $add = $connection->connect()->prepare("INSERT INTO user (name, surname, email, password, country) VALUES (:name, :surname, :email, :password, :country)");
        $add->bindValue(":name",$name);
        $add->bindValue(":surname",$surname);
        $add->bindValue(":email",$email);
        $add->bindValue(":password",$password);
        $add->bindValue(":country",$country);
        $add->execute();
    }
    public function selectUser(){
        $connection = new Connection();
        $select = $connection->connect()->prepare("SELECT * FROM user");
        $select->execute();
        $userthis = array();
        foreach($select as $users){
            $user = new User();
            $user->setId($users['ID']);
            $user->setEmail($users['email']);
            $user->setSurname($users['surname']);
            $user->setCountry($users['country']);
            $user->setName($users['name']);
            $userthis = $user;
        }
        return $userthis;
    }
     public function login($email, $password){
        $connection = new Connection();
        $login = $connection->connect()->prepare("SELECT ID, password FROM user WHERE email = :email");
        $login->bindValue(":email",$email);
        $login->execute();
        $users = array();
        foreach($login as $user){
            if(password_verify($password, $user["password"]))
                return $user["ID"];
            else
                return 0;
        }
        return 0;
        
    }
    public function delete($id){
        $connection = new Connection();
        $delete = $connection->connect()->prepare("DELETE FROM user WHERE ID = :id");
        $delete->bindValue(":id",$id);
        $delete->execute();
    }
}