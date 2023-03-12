<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $arr1 = [
            'a' => 'test',
            'b' => 'test1',
        ];
        $arr3 = $arr1;
        $arr2 = [
            'b' => 'test1',
            'a' => 'test',
            'c' => '1'
        ];
        dd($arr1 == $arr2, $arr1, $arr2);
    }

    public function test()
    {
        $this->test1();
    }

    public function test1()
    {
        $this->test2();
    }

    public function test2()
    {
        $a = LogHelper::write(4);
    }
}
