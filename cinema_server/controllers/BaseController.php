<?php

require_once __DIR__ . "/../connection/connection.php";
require_once __DIR__ . "/../services/ResponseService.php";

abstract class BaseController
{
    protected $db;
    public function __construct()
    {
        global $mysqli;
        $this->db = $mysqli;
    }

    protected function handle(callable $action)
    {
        try {
            $data = $action();
            echo ResponseService::success_response($data);
        } catch (\Exception $e) {
            echo ResponseService::error_response($e->getMessage());
        }
    }

}
