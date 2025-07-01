<?php 
require("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(250) NOT NULL,
    casting TEXT NOT NULL,
    producer VARCHAR(250) NOT NULL,
    director VARCHAR(250) NOT NULL,
    duration VARCHAR(250) NOT NULL,
    description TEXT,
    country VARCHAR(250) NOT NULL,
    image_base64 LONGTEXT NOT NULL,
    start_date DATE,
    end_date DATE
);";


$execute = $conn->prepare($query);
$execute -> execute();

?>