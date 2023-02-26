<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $defaultLimit = 10;
    const LIMIT_RANGE = [5, 10, 20, 50, 100, 500];

    public function __construct()
    {

    }

    public function prepare(Request &$request)
    {
        $limit = $request->input('limit', $this->defaultLimit);
        $limit = (int)$limit;
        $limit = in_array($limit, static::LIMIT_RANGE, true) ? $limit : $this->defaultLimit;
        $request->request->set('limit', $limit);
    }
}
