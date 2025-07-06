<?php 
abstract class Model{

    protected static string $table;
    protected static string $primary_key = "id";

    public static function find(mysqli $mysqli, int $id){
        $sql = sprintf("Select * from %s WHERE %s = ?", 
                        static::$table, 
                        static::$primary_key);
        
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function all(mysqli $mysqli){
        $sql = sprintf("Select * from %s", static::$table);
        
        $query = $mysqli->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while($row = $data->fetch_assoc()){
            $objects[] = new static($row); 
        }

        return $objects; 
    }

    public static function delete(mysqli $mysqli, int $id){
        $sql = sprintf("Delete from %s WHERE %s = ?", 
                        static::$table, 
                        static::$primary_key);
        
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $result = $query->execute();
        return $result;
    }           

    public static function deleteAll(mysqli $mysqli){
        $sql = sprintf("Delete from %s", static::$table);

        $query = $mysqli->prepare($sql);
        return $query->execute();
     
    }

    public static function create(mysqli $mysqli, array $data)
    {
        $columns      = implode(',', array_keys($data));
        $values       = "'" . implode("','", array_values($data)) . "'";
        $sql          = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::$table,
            $columns,
            $values
        );
        $mysqli->query($sql);
        $newId = $mysqli->insert_id;
        return static::find($mysqli, $newId);
    }

   public static function update(mysqli $mysqli, array $data){
    
    $id = $data['id'];
    unset($data['id']);

    $columns = implode(',', array_keys($data));
    $values  = "'" . implode("','", array_values($data)) . "'";

    $sql = sprintf(
        "UPDATE %s SET (%s) = (%s) WHERE %s = %d",
        static::$table,
        $columns,
        $values,
        static::$primary_key,
        $id
    );

    return $mysqli->query($sql);
}
}



