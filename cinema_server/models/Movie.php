<?php
require_once("Model.php");              

class Movie extends Model {

    private int $id;
    private string $title;
    private string $producer;
    private string $director;
    private string $duration;
    private string $description;
    private string $country;
    private string $image_base64;
    private string $start_date;
    private string $end_date;

    protected static string $table = "movies";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->producer = $data["producer"];
        $this->director = $data["director"];
        $this->duration = $data["duration"];
        $this->description = $data["description"];
        $this->country = $data["country"];
        $this->image_base64 = $data["image_base64"];
        $this->start_date = $data["start_date"];
        $this->end_date= $data["end_date"];
    }

    public function toArray() {
        return [
            
            "id" => $this->id,
            "title" => $this->title,
            "producer" => $this->producer,
            "director" => $this->director,
            "duration" => $this->duration,
            "description" => $this->description,
            "country" => $this->country,
            "poster"=> $this->image_base64,   
            "start_date" => $this->start_date,
            "end_date" => $this->end_date
        ];
    }
}
