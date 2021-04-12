<?php
class UserDepartment{
    private $id;
    private $user;
    private $department;
    
    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getDepartment() {
        return $this->department;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setDepartment($department) {
        $this->department = $department;
    }

}