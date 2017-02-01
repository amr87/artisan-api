<?php

namespace App\Modules\Helpers;

Abstract class AbstractRepository {

    protected static function setCorsHeaders() {

        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin,Authorization',
        ];
        foreach ($headers as $key => $value) {
            header($key . ":" . $value);
        }
    }

    public static function isJson($string) {
        if(is_array($string))
            return false;
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

}
