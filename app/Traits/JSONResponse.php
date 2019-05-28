<?php
/**
 * Created by PhpStorm.
 * User: abeeb
 * Date: 6/1/18
 * Time: 4:22 PM
 */

namespace App\Traits;

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

}