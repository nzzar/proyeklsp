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
    
    public function registerEvent(Request $request, $id) {
        return view('event.event-detail', compact('id'));
    }

    public function asesmentMandiri(Request $request, $id) {
        return view('event.asesment-mandiri', compact('id'));
    }

    public function skemaAsesi(Request $request, $id) {
        return view('event.event-asesi', compact('id'));
    }
}
