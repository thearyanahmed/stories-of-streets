<?php

use function Sodium\randombytes_random16;

if(! function_exists('res')) {
    function res($data,int $code = 200) {
        return response()->json($data,$code);
    }
}

if(! function_exists('not_found_response')) {
    function not_found_response($data) {
        return res($data,404);
    }
}

if(! function_exists('error_response')) {
    function error_response($data,int $code = 422) {
        return res($data,$code);
    }
}

if(! function_exists('unique_device_id')) {
    function unique_device_id() {
        return 'web-' . now()->unix() . '-' . bin2hex(random_bytes(12));
    }
}

