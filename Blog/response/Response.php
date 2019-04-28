<?php

namespace App;


class Response
{
    public static function toApi($object, $status){
        return response()->json(['data' => $object],$status);
    }
}
