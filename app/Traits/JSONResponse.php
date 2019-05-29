<?php
/**
 * Created by PhpStorm.
 * User: abeeb
 * Date: 6/1/18
 * Time: 4:22 PM
 */

namespace App\Traits;

use App\Utils\Error;

trait JSONResponse
{

    public function sendSuccessResponse($data)
    {
        $response = [
            'status' => 'success',
            'data' => $data
        ];
        return response()->json($response);
    }

    public function sendErrorResponse($msg = null, $data = null, $statusCode = 200)
    {
        $response = [
            'status' => 'error',
            'msg' => $msg ,
            'data' => $data
        ];
        return response()->json($response, $statusCode);
    }

    public function sendFatalErrorResponse($exception, $data = null, $statusCode = 500)
    {
        $response = [
            'status' => 'error',
            'msg' => Error::FATAL,
            'data' => $data
        ];
        return response()->json($response, $statusCode);
    }

}