<?php

require __DIR__ . '/../connection/connection.php';

class UsersSeeder {
    public function insertUser() {
        global $mysqli;
        $passwordHash = password_hash('Issam@123', PASSWORD_DEFAULT);
        $query = "INSERT INTO users (first_name, last_name, email, password, phone_number) VALUES ('nagham', 'morcos', 'naghammorcos@gmail.com', '{$passwordHash}', '71933146')";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
    }
}
