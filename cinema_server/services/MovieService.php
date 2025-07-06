<?php 

class MovieService {

    public static function moviesToArray($movies_array){
        $results = [];

        foreach($movies_array as $c){
             $results[] = $c->toArray(); 
        } 

        return $results;
    }



}