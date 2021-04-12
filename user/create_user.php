<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new user($db);

// set user property values
$user->name = $_POST['name'];
$user->email = $_POST['email'];
$user->password = base64_encode($_POST['password']);
$user->phone = $_POST['phone'];
$user->gender = $_POST['gender'];
$user->specialist = $_POST['specialist'];
$user->created = date('Y-m-d H:i:s');

// create the user
if ($user->create()) {
    $user_arr = array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "name" => $user->name,
        "email" => $user->email,
        "phone" => $user->phone,
        "gender" => $user->gender,
        "specialist" => $user->specialist
    );
} else {
    $user_arr = array(
        "status" => false,
        "message" => "Email already exists!"
    );
}
print_r(json_encode($user_arr));
