<?php
require("../connection/connection.php");

class User{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;        
    private string $phone_number;
    private string $created_at;
    private string $updated_at;

    protected static string $table = "users";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->first_name = $data["first_name"];
        $this->last_name = $data["first_name"];
        $this->email = $data["email"];
        $this->password = $data["password"];
        $this->phone_number = $data["phone_number"];
        $this->created_at = $data["created_at"];
        $this->updated_at = $data["updated_at"];
    }

    public function toArray(){
        return [$this->id, $this->$first_name, $this->$last_name, $this->$email, $this->$password, $this->$phone_number, $this->$created_at, $this->$updated_at];
    }

    public static function verify_email_and_password(mysqli $conn,string $email,string $password){

        $response = [];

        $sql = "Select * FROM users where email = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("s",$email);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        if(!$data){
            $response["ok"] = false;
            $response["error"] = "Not valid Credentials";
            return $response;
        }

        if(password_verify($password, $data["password"])){
            $response["ok"] = true;
            $response["user"] = $data;
        }
        else{
            $response["ok"] = false;
            $response["error"] = "Not valid Credentials";
        }           
         return $response;
    }

        public static function check_email_existence(mysqli $conn, string $email): bool {
        $sql = "SELECT id FROM users WHERE email = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();
        $query->store_result();
        $exists = $query->num_rows > 0;
        $query->close();
        return $exists;
    }

    public static function insert(mysqli $conn, array $data): array {
        $response = [];

        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);

        $sql   = "INSERT INTO users (first_name, last_name, email, password, phone_number) VALUES (?, ?, ?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param(
            "sssss",
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $hashed_password,
            $data['phone_number']
        );

        if ($query->execute()) {
            $response["ok"] = true;
        } else {
            $response["ok"] = false;
            $response["error"] = "Database error";
        }

        $query->close();
        return $response;
    }}