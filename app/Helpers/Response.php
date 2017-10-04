<?php

namespace App\Helpers;

class Response {
    public static $fail = ['status' => false, 'message' => 'Algo salió mal. :(', 'data' => null];

    public static function set($status, $message, $data = null){
        $response = ['status' => $status, 'message' => $message, 'data' => $data];
        return $response;
    }
}

?>
