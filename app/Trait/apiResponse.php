<?php

namespace App\Trait;

trait apiResponse
{
    protected function responseWithError($message){
        return response([
            'success' => false,
            'message' => $message
        ]);
    }
    protected function responseWithSuccess($message, $data){
        return response([
            'success' => true,
            'message' => $message,
            'data,' => $data,
        ]);
    }
}
