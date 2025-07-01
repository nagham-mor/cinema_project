<?php
require("../connection/connection.php");



$sql = "INSERT INTO seats (movie_id, seat_label) VALUES
  (1, 'A1'), (1, 'A2'), (1, 'A3'), (1, 'A4'), (1, 'A5'),
  (1, 'B1'), (1, 'B2'), (1, 'B3'), (1, 'B4'), (1, 'B5'),
  (1, 'C1'), (1, 'C2'), (1, 'C3'), (1, 'C4'), (1, 'C5');
";

$conn->query($sql);