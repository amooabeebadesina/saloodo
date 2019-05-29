<?php


namespace App\Http\Controllers;


class UtilityController extends Controller
{

    public function ping()
    {
        $str = str_random(10);
        return $this->sendSuccessResponse(['up' => $str]);
    }


}