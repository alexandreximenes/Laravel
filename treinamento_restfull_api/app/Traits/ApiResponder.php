<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponder
{
    private function successResponde($data, $code){
        return response()->json($data, $code);
    }

    protected function errorResponde($message, $code){
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200){
        return $this->successResponde(['data' => $collection], $code);
    }

    protected function showOne(Model $model, $code){
        return $this->successResponde(['data' => $model], $code);
    }
}
