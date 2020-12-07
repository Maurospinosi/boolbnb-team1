<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\House;

class StatisticController extends Controller
{

    public function index($id)
    {

        $house = House::find($id);

        if (Auth::id() == $house->user_id) {
            return view("host/statistic.index", compact('id'));
        } else {
            return redirect()->route('guest/house', $house->slug);
        }
    }
}