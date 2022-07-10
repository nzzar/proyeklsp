<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request) {
        return view('event.event-management');
    }

    public function detail(Request $request, $id){
        return view('event.event-detail', compact('id'));
    }
}
