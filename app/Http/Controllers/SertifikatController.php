<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SertifikatController extends Controller
{
    public function index($id) {
        try {
            $event = Event::findOrFail($id);
            $role = Auth::user()->role;
            return view('event.sertifikat-asesi', compact('role', 'id'));
        } catch (Exception $err) {
            abort(404);
        }
    }
}
