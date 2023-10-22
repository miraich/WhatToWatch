<?php

namespace App\Http\Controllers;

use App\Http\Responses\Fail;
use App\Http\Responses\Success;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function success($data, ?int $code = Response::HTTP_OK)
    {
        return new Success($data, $code);
    }

    protected function fail($data, string $message)
    {
        return new Fail($data, $message);
    }
}
