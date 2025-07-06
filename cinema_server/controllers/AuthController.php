<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__ . '/../services/ResponseService.php';

class AuthController extends BaseController {
 public function register()
    {
        try {
            $data = [
                'first_name'   => trim($_GET['first_name']   ?? ''),
                'last_name'    => trim($_GET['last_name']    ?? ''),
                'email'        => trim($_GET['email']        ?? ''),
                'password'     => trim($_GET['password']     ?? ''),
                'phone_number' => trim($_GET['phone_number'] ?? ''),
            ];


            $newUser = UserService::register($this->db, $data);
            echo ResponseService::success_response([
                'id'           => $newUser->getId(),
                'first_name'   => $newUser->getFirstName(),
                'last_name'    => $newUser->getLastName(),
                'email'        => $newUser->getEmail(),
                'phone_number' => $newUser->getPhoneNumber(),
            ]);
        } catch (Exception $e) {
            echo ResponseService::error_response($e->getMessage());
        }

    }

    public function login(){    
         try {
            $data = [
            'email'        => trim($_GET['email']        ?? ''),
            'password'     => trim($_GET['password']     ?? ''),
            ];

            $user = UserService::login($this->db, $data);

            echo ResponseService::success_response([
                'id'           => $user->getId(),
                'first_name'   => $user->getFirstName(),
                'last_name'    => $user->getLastName(),
                'email'        => $user->getEmail(),
                'phone_number' => $user->getPhoneNumber(),
            ]);

            }catch(Exception $e){
            echo ResponseService::error_response($e->getmessage());
        }

    }
}
