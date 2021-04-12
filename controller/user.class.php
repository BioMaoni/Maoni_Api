<?php
class User{
    private $id;
    private $email;
    private $name;
    private $surname;
    private $company;
    private $country;
    private $password;
    
    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getCompany() {
        return $this->company;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setCompany($company) {
        $this->company = $company;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

}