<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //success response
    //return http response with status code and message

    public function successResponse($result, $message )
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    //error response
    public function errorResponse($error, $code)
    {
        $response = [
            'success' => false,
            'message' => $error
        ];


        return response()->json($response, $code);
    }
}
