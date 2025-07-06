<?php
require_once __DIR__ . '/../connection/connection.php';
require_once("Model.php");

class User extends Model{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;        
    private string $phone_number;
    private string $created_at;
    private ?string $updated_at;

    protected static string $table = "users";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->first_name = $data["first_name"];
        $this->last_name = $data["last_name"];
        $this->email = $data["email"];
        $this->password = $data["password"];
        $this->phone_number = $data["phone_number"];
        $this->created_at = $data["created_at"];
        $this->updated_at = $data["updated_at"];
    }

    public function getId(){ 
        return $this->id; 
    }
    public function getFirstName(){ 
        return $this->first_name; 
    }
    public function getLastName(){
        return $this->last_name; 
    }
    public function getEmail(){
         return $this->email;
    }
    public function getPassword(){
         return $this->password; 

    }
    public function getPhoneNumber(){ 
        return $this->phone_number; 
    }
    public function getCreatedAt(){
        return $this->created_at; 
    }
    public function getUpdatedAt(){
        return $this->updated_at; 
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

    public static function findByEmail(mysqli $db, $email)
    {
        $sql  = "SELECT * FROM " . static::$table . " WHERE email = ? LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $row  = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return $row ? new static($row) : null;
    }
   }