<?php
include_once '../../config/database.php';
include_once '../../objects/country.php';


$database = new Database();
$db = $database->getConnection();

$country = new Country($db);

$stmt = $country->read();
$num = $stmt->rowCount();

if($num>0){
    $countries_arr=array();
    $$countries_arr["countries"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $country_item=array(
            "ID"=>$id,
            "name"=>$name
        );
        array_push($countries_arr["countries"], $country_item);
    }

    echo json_encode($countries_arr["countries"]);
}
else {
    echo json_encode(array());
}

