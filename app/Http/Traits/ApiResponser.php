<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use PhpParser\ErrorHandler\Collecting;

trait ApiResponser {
  


    private function successResponser($data, $code ){
        return response()->json($data , $code );
    }

    protected function errorResponser($message , $code ){
        return response()->json(['error'=> $message, 'code' => $code], $code );
    }

    protected function showAll(Collecting $collection , $code = 200){
        return $this->successResponser(['data' => $collection], $code);
    }
    protected function showOne( Model $model , $code = 200) {
        return $this->successResponser(['data' => $model ] , $code);
    }

    
}