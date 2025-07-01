<?php 
require("../connection/connection.php");


$query="CREATE TABLE IF NOT EXISTS users_favorite_genres(
    id INT AUTO_INCREMENT PRIMARY KEY,users_id INT NOT NULL,
    genres_id INT NOT NULL,
    FOREIGN KEY (users_id) REFERENCES users(id),
    FOREIGN KEY (genres_id) REFERENCES genres(id)
     );";


$execute = $conn->prepare($query);
$execute -> execute();

?>