<?php 
require("../connection/connection.php");


$query="CREATE TABLE IF NOT EXISTS genres_films(
    id INT AUTO_INCREMENT PRIMARY KEY,
    film_id INT NOT NULL,
    genres_id INT NOT NULL,
    FOREIGN KEY (film_id) REFERENCES movies(id),
    FOREIGN KEY (genres_id) REFERENCES genres(id)
     );";

$execute = $conn->prepare($query);
$execute -> execute();

?>