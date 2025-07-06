<?php 

class UserService {

    public static function usersToArray($users_array){
        $results = [];

        foreach($users_array as $c){
             $results[] = $c->toArray(); 
        } 

        return $results;
    }

    public static function validateRegistration(array $data){
        if (empty($data['first_name'])) {
            throw new InvalidArgumentException('first_name is required');
        }
        if (empty($data['last_name'])) {
            throw new InvalidArgumentException('last_name is required');
        }
        if (empty($data['email'])) {
            throw new InvalidArgumentException('email is required');
        }
        if (empty($data['password'])) {
            throw new InvalidArgumentException('password is required');
        }
    }

    private static function hashPassword($password){

        return password_hash($password, PASSWORD_DEFAULT);
    }
    

    public static function register(mysqli $db, array $data){
        self::validateRegistration($data);

        $existing = User::findByEmail($db, $data['email']);
        if ($existing) {
            throw new Exception('Email already registered');
        }

        $data['password'] = self::hashPassword($data['password']);
        return User::create($db, $data);

    }
     public static function validateLogin(array $data){
        if (empty($data['email'])) {
            throw new InvalidArgumentException('email is required');
        }
        if (empty($data['password'])) {
            throw new InvalidArgumentException('password is required');
        }
    }


     public static function login(mysqli $db, array $data){
        self::validateLogin($data);

        $user = User::findByEmail($db, $data['email']);
        if (!$user) {
            throw new Exception('Email not found');
        }
        if (!password_verify($data['password'], $user->getPassword())) {
            throw new Exception('Invalid credentials');
        }

        return $user;
    }
}