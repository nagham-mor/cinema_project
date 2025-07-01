<?php
require("../connection/connection.php");

$pass1 = password_hash('Issam@123',  PASSWORD_DEFAULT);

$sql = "INSERT INTO users
(first_name, last_name, email, password, phone_number) VALUES
('nagham', 'morcos', 'naghammorcos@gmail.com', '$pass1', '71933146'),";

$conn->query($sql);

    