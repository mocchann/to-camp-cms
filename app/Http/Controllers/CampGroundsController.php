<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampGroundsController extends Controller
{
    public function index(Request $request)
    {
        return view('camp_grounds.index');
    }
}
