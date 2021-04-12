<?php
class Connection{
    public function connect(){
        $usr = "root";
        $pwd = "";
        return new PDO("mysql:host=localhost;dbname=maoni",$usr,$pwd);
    }
}