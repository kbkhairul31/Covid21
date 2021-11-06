<?php

namespace App\Http\Traits;

use Illuminate\Support\Collection;

 use Illuminate\Database\Eloquent\Model;

trait ApiResponser {



    private function successResponser($data, $code ){
        return response()->json($data , $code );
    }

    protected function errorResponser($message , $code ){
        return response()->json(['error'=> $message, 'code' => $code], $code );
    }

    protected function showAll(Collection $collection , $code = 200){
        return $this->successResponser(['data' => $collection], $code);
    }
    protected function showOne( Model $model , $code = 200) {
        return $this->successResponser(['data' => $model ] , $code);
    }


}
