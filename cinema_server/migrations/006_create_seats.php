
<?php 
require("../connection/connection.php");


$query="CREATE TABLE IF NOT EXISTS seats(
  movie_id    INT         NOT NULL,      
  seat_label  VARCHAR(10) NOT NULL,      
  user_id     INT         DEFAULT NULL,  
  reserved_at DATETIME    NULL,          
  PRIMARY KEY (movie_id, seat_label),
  FOREIGN KEY (movie_id) REFERENCES movies(id),
  FOREIGN KEY (user_id)  REFERENCES users(id)
     );";


$execute = $conn->prepare($query);
$execute -> execute();

?>
