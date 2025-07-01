<?php
require("../models/Movie.php");
require("../connection/connection.php");
header('Content-Type: application/json');

$response = ['movies' => []];
$id = $_GET['id'] ?? '';

if ($id === '') {
    $movies = Movie::all($conn);
    foreach ($movies as $movie) {
        $response['movies'][] = $movie->toArray();
    }
} else {
    $movie = Movie::find($conn, $id);
    $response['movies'] = $movie
        ? [ $movie->toArray() ]
        : [];
}

echo json_encode($response);
