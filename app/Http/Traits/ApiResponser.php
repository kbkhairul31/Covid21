<?php

namespace App\Http\Traits;

use Illuminate\Support\Collection;

use Illuminate\Database\Eloquent\Model;
use PhpParser\ErrorHandler\Collecting;

trait ApiResponser
{



    private function successResponser($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponser($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {

        if ($collection->isEmpty()) {
            return $this->successResponser(['data' => $collection], $code);
        }
        $transformer = $collection->first()->transformer;

        $collection = $this->sortData($collection , $code);
        

        $collection = $this->transformData($collection, $transformer);

        return $this->successResponser(  $collection, $code);
    }
    protected function showOne(Model $instance, $code = 200)
    {

        $transformer = $instance->transformer;

        $instance = $this->transformData($instance, $transformer);

        return $this->successResponser(  $instance, $code);
    }

    protected function transformData($data, $transformer)
    {

        $transformation = fractal($data, new $transformer);

        return $transformation->toArray();
    }

    protected function showMessage($message , $code = 200){

        return $this->successResponser(['data' => $message], $code);
    }

    protected function sortData( Collection $collection ){

        if (request()->has('sort_by')) {
            $attribute = request()->sort_by;

            $collection = $collection->sortBy->{$attribute};
            // $collection = $collection->sortBy($attribute);
        }

        return $collection;
    }
}
