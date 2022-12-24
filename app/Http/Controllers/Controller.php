<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($data = null, $status = 200)
    {
        return response()->json($data, $status, [], JSON_NUMERIC_CHECK);
    }

    public function sendError($error = 'Ha ocurrido un error', $status = 400)
    {
        return $this->sendResponse($error, $status);
    }
}
