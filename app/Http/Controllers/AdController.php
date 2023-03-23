<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Flat;
use App\Models\LandPlot;

class AdController extends Controller
{
    // INDEX METHODS
    public function index()
    {
        return view('index');
    }

    public function preCreate()
    {
        return view('ads.preCreate');
    }
}
