<?php 
require("../connections/connection.php");

$query="CREATE TABLE images_films(
    id INT AUTO_INCREMENT PRIMARY KEY,film_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (film_id) REFERENCES movies(id)
     );";


$execute = mysqli->prepare($query);
$execute = execute();

?>