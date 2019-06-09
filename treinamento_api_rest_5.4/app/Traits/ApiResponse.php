<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponse{

    private function successResponse($data, $code){

        return response()->json(['data' => $data], $code);
    }

    protected function errorResponse($message, $code = 400){

        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200){

        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $model, $code = 200){

        return $this->successResponse($model, $code);
    }
}