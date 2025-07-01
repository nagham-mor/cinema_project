<?php 
require("../models/User.php");
require("../connection/connection.php");

$response = [];
$response["status"] = 200;

if (!isset($_GET["email"]) || !isset($_GET["password"])) {
    $response["ok"] = false;
    $response["error"] = "Missing email or password";
    echo json_encode($response);
    return;
}

$email = $_GET["email"];
$password =  $_GET["password"];

$sql = "Select * FROM users where email = ?";
$query = $conn->prepare($sql);
$query->bind_param("s",$email);
$query->execute();

$data = $query->get_result()->fetch_assoc();

if(!$data){
    $response["ok"] = false;
    $response["error"] = "Incorrect Password or Email Not found";
    echo json_encode($response);
    return;
}

if(password_verify($password, $data["password"])){
    $response["ok"] = true;
    $response["user"] = $data;
}
else{
    $response["ok"] = false;
    $response["error"] = "Incorrect Password or Email Not found";
}

echo json_encode($response);

return;

?>






