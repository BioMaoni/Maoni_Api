<?php
require_once "country.class.php";
require_once "Connect.php";
class CountryDB{
    public function selectAll(){
        $connection = new Connection();
        $select = $connection->connect()->prepare("SELECT * FROM country");
        $select->execute();
        $countrythis = array();
        foreach($select as $country){
            $countries = new Country();
            $countries->setId($country["ID"]);
            $countries->setName($country["name"]);
            $countrythis[] = $countries;
        }
        return $countrythis;
    }
}