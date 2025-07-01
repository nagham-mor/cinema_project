<?php
abstract class Model
{
    protected static string $table;
    protected static string $primary_key   = "id";

    protected static string $table_1;
    protected static string $primary_key_1 = "id";

    public static function find(mysqli $conn, int $id)
    {
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = ?",
            static::$table,
            static::$primary_key
        );

        $query = $conn->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();
        return $data ? new static($data) : null;
    }

    public static function find_join_tables(mysqli $conn, int $id)
    {
        $sql = sprintf(
            "SELECT * FROM %s
             JOIN %s ON %s.%s = %s.%s
             WHERE %s.%s = ?",
            static::$table,
            static::$table_1,
            static::$table,   static::$primary_key,
            static::$table_1, static::$primary_key_1,
            static::$table,   static::$primary_key
        );

        $query = $conn->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();
        return $data ? new static($data) : null;
    }

    public static function all(mysqli $conn): array
    {
        $sql    = sprintf("SELECT * FROM %s", static::$table);
        $query  = $conn->prepare($sql);
        $query->execute();

        $result  = $query->get_result();
        $objects = [];
        while ($row = $result->fetch_assoc()) {
            $objects[] = new static($row);
        }

        return $objects;
    }

    public static function all_on_join(mysqli $conn): array
    {
        $sql = sprintf(
            "SELECT * FROM %s
             JOIN %s ON %s.%s = %s.%s",
            static::$table,
            static::$table_1,
            static::$table,   static::$primary_key,
            static::$table_1, static::$primary_key_1
        );

        $query  = $conn->prepare($sql);
        $query->execute();

        $result  = $query->get_result();
        $objects = [];
        while ($row = $result->fetch_assoc()) {
            $objects[] = new static($row);
        }

        return $objects;
    }
}
?>
