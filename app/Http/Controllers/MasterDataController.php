<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function prodiManagement() {
        return view('master.prodi-management');
    }
}
