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
    protected function availableStock(){
        return response([
            'success' => false,
            'message' => 'Rupture de Stock',
        ]);
    }
    protected function minimumStock(){
        return response([
            'success' => false,
            'message' => 'La quantite d\'un article ne doit pas être inférieure à 1',
        ]);
    }
    protected function responseWithSuccess($message){
        return response([
            'success' => true,
            'message' => $message,
        ]);
    }
}
