<?php
class Department{
    private $id;
    private $name;
    private $company;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCompany() {
        return $this->company;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setCompany($company) {
        $this->company = $company;
    }

}