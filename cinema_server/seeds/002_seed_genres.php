
<?php
require("../connection/connection.php");

$sql = "INSERT INTO genres (name) VALUES
  ('Action'),'Comedy'),('Drama'),('Horror'),('Sci-Fi')";
$conn->query($sql);

