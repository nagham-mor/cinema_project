<?php
header('Content-Type: application/json');
require_once "../connection/connection.php";
require_once "../models/User.php";

$response = ['status' => 200];

$firstName = $_GET['first_name']   ?? '';
$lastName = $_GET['last_name']    ?? '';
$email = $_GET['email']        ?? '';
$password = $_GET['password']     ?? '';
$phoneNumber = $_GET['phone_number'] ?? '';

if ($firstName === '' || $lastName === '' || $email === '' || $password === '') {
    $response['ok']    = false;
    $response['error'] = 'Missing required fields';
    echo json_encode($response);
    return;
}

if (User::check_email_existence($conn, $email)) {
    $response['ok']    = false;
    $response['error'] = 'Email already registered';
    echo json_encode($response);
    return;
}

$response = User::insert($conn, ['first_name' => $firstName,'last_name'=> $lastName,'email'=> $email,'password'=> $password,'phone_number' => $phoneNumber]);

echo json_encode($response);
