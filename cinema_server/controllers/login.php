<?php 
require("../models/User.php");
require("../connection/connection.php");



$response = [];
$response["status"] = 200;

//use method post in axios login.js
// $body     = json_decode(file_get_contents('php://input'), true);
// $email    = $body['email']    ?? '';
// $password = $body['password'] ?? '';


$email = $_GET['email'] ?? '' ;
$password = $_GET['password'] ?? '' ;

if ($email ===''|| $password === '') {
    $response["ok"] = false;
    $response["error"] = "Missing email or password";
    echo json_encode($response);
    return;
}



$response = User::verify_email_and_password($conn,$email,$password);

echo json_encode($response);

return;

?>






