<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index(Event $event)
    {
        return view('reports.index', compact('event'));
    }
}
