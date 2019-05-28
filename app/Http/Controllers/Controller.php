<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\JSONResponse;

class Controller extends BaseController
{
    use JSONResponse;
}
