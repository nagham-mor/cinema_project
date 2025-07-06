<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Movie.php';
require_once __DIR__ . '/../services/MovieService.php';
require_once __DIR__ . '/../services/ResponseService.php';

class MovieController extends BaseController {
    public function getAllMovies(){
        try{
        
            $movies = Movie::all($this->db);
            $movies_array = MovieService::moviesToArray($movies);
            echo ResponseService::success_response($movies_array);

            }catch(Exception $e){
            echo ResponseService::error_response($e->getmessage());
        }

    }

    public function getSpecificMovie(){
        try{
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $movies = Movie::find($this->db, $id)->toArray();
            echo ResponseService::success_response($movies);

            }catch(Exception $e){
            echo ResponseService::error_response($e->getmessage());
        }

    }
}
