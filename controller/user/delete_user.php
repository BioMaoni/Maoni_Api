<?php

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$user = new User($db);

// set doctor property values
$user->id = $_POST['id'];

// remove the doctor
if ($user->delete()) {
    $user_arr = array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
} else {
    $user_arr = array(
        "status" => false,
        "message" => "User Cannot be deleted!"
    );
}
print_r(json_encode($user_arr));
