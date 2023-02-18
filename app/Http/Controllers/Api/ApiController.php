<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $auth = null;

    public function __construct()
    {
        $this->auth = auth('api');
    }
}
