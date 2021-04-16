<?php
class Company{
    private $id;
    private $name;
    private $admin;
    private $country;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getCountry() {
        return $this->country;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function setCountry($country) {
        $this->country = $country;
    }
    
}