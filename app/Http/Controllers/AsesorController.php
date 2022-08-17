<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsesorController extends Controller
{
    public function index() {
        return view('asesor.asesor-management');
    }

    public function create(Request $request, $id = null) {
        return view('asesor.asesor-form' , compact('id'));

    }

    public function meninjauAsesmen($id) {
        return view('asesor.meninjau-asesment', compact('id'));
    }
}
