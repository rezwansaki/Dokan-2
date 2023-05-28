<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // to show settings 
    public function index()
    {
        return 'Settings';
    }

    //Setting::where('active', 1)->where('destination', 'San Diego')->update(['delayed' => 1]);
}
