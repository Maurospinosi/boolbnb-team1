<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;

use App\House;
use App\View;

class StatisticController extends Controller
{

    public function index($id)
    {
        return view("host/statistic.index", compact('id'));
    }
}