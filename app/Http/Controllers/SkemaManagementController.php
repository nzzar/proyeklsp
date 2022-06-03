<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Exception;
use Illuminate\Http\Request;

class SkemaManagementController extends Controller
{
    public function index () {
        return view('skema.skema-management');
    }

    public function datail(Request $request, $id) {
        try {
            $skema = Skema::findOrFail($id);

            return view('skema.skema-detail', compact('skema'));
        } catch(Exception $e) {
            dd($e);
        }
    }
}
