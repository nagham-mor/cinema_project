<?php 
require("../connection/connection.php");


$query= "CREATE TABLE IF NOT EXISTS genres(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250) NOT NULL
     );";
    
$execute = $conn->prepare($query);
$execute -> execute();

?>