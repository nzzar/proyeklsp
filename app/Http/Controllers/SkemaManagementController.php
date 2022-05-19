<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkemaManagementController extends Controller
{
    public function index () {
        return view('skema.skema-management');
    }
}
