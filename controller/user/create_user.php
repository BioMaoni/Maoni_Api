<?php

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);

// set user property values
$user->name = $_POST['name'];
$user->surname = $_POST['surname'];
$user->email = $_POST['email'];
$user->password = base64_encode($_POST['password']);
$user->country = $_POST['country'];

// create the user
if ($user->create()) {
    $user_arr = array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "name" => $user->name,
        "surname" => $user->surname,
        "email" => $user->email,
        "password" => $user->password,
        "country" => $user->country
    );
} else {
    $user_arr = array(
        "status" => false,
        "message" => "Email already exists!"
    );
}
print_r(json_encode($user_arr));
