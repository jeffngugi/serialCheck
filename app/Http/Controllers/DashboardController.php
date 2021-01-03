<?php

namespace App\Http\Controllers;
use App\Models\Serial;
use App\Models\Lot;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $serials = Serial::all();
        // $totalSerials = Serial::count();
        $totalSerials = Serial::max('id');
        // $totalDownload = Serial::whereNotNull('lotNumber')->count();
        $totalDownload = Lot::sum('count');
        $appovedCodes = Serial::where('checked', true)->count();
        // return view('home')->with('totalSerials', $totalSerials);
        // $totalSerials = Serial::count();
        // return $totalSerials;
        // return $totalSerials;
        return view('home')->with('totalSerials', $totalSerials)->with('totalDownload', $totalDownload)->with('appovedCodes', $appovedCodes);
    }
}
