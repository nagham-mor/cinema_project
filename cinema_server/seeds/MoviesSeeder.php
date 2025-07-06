<?php
require("../connection/connection.php");

class MoviesSeeder {
    public function insertMovies() {
        global $mysqli;
        $query = "INSERT INTO movies (title, producer, director, duration, description, country, image_base64, start_date, end_date) VALUES ('Fast X','Universal','Louis Leterrier','141','Dom and crew face a vengeful threat.','USA','$posterFastx','2025-06-01','2025-08-01'),
        ('Barbie','WB','Greta Gerwig','114','Barbie and Ken explore the real world.','USA','$posterBarbie','2025-06-10','2025-07-20'),
        ('Oppenheimer','Universal','Christopher Nolan','180','Story of the father of the atomic bomb.','USA','$posterOppenheimer','2025-06-15','2025-08-30'),
        ('Inside Out 2','Pixar','Kelsey Mann','95','Riley faces new emotions as a teen.','USA','$posterInside','2025-07-10','2025-09-15'),
        ('Mission 7','Paramount','Chris McQuarrie','165','Ethan Hunt’s next impossible mission.','USA','$posterMission','2025-07-20','2025-10-01')";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
    }
}
