<?php 
$apis = [


    //categories

     //movies
    '/get_all_movies'        => ['controller' => 'MovieController', 'method' => 'getAllMovies'],

     '/get_specific_movie'        => ['controller' => 'MovieController', 'method' => 'getSpecificMovie'],

    //AuthController
    '/login'         => ['controller' => 'AuthController', 'method' => 'login'],
    '/register'         => ['controller' => 'AuthController', 'method' => 'register'],

];

