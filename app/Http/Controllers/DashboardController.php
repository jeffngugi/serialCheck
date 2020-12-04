<?php

namespace App\Http\Controllers;
use App\Models\Serial;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $serials = Serial::all();
        // return view('serial.index')->with('serails',$serials);
        $totalSerials = Serial::count();
        // return view('home')->with('totalSerials', $totalSerials);
        // $totalSerials = Serial::count();
        // return $totalSerials;
        // return $totalSerials;
        return view('home')->with('totalSerials', $totalSerials);
    }
}
