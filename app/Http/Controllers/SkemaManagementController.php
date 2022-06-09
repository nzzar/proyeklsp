<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use App\Models\UnitKompetensi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SkemaManagementController extends Controller
{
    public function index()
    {
        return view('skema.skema-management');
    }

    public function datail(Request $request, $id)
    {
        try {
            $skema = Skema::with('persyaratan')->where('id', $id)->firstOrFail();

            return view('skema.skema-detail', compact('skema'));
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nomor' => 'required|min:5|max:50',
            'name' => 'required|min:5|max:50',
            'active' => 'in:y,n'
        ]);


        try {
            $skema = Skema::findOrFail($id);
            $skema->nomor = $request->nomor;
            $skema->name = $request->name;
            $skema->active = $request->active == 'y' ? true : false;
            $skema->save();

            Session::flash('success', 'Skema berhasil diperbarui!');
            return redirect("/skema/$id");
        } catch (Exception $e) {
            return redirect("/skema/$id/update")->withErrors(['skemaUpdateError', 'Gagal memperbaharui data skema']);
        }
    }

    public function unitKompetensi(Request $request, $id)
    {
        $data = UnitKompetensi::where('id', $id)
            ->with('skema')
            ->firstOrFail();

        return view('skema.unit-kompetensi-detail', compact('data'));
    }

    public function updateUnitKompetensi(Request $request, $id)
    {
        $request->validate(
            [
                'kode' => 'required',
                'judul' => 'required',
            ],
            [],
            [
                'kode' => 'Kode unit',
                'judul' => 'Judul unit',
            ],
        );

        try {

            $data = UnitKompetensi::findOrFail($id);
            $data->kode = $request->kode;
            $data->judul = $request->judul;
            $data->save();

            Session::flash('success', 'Unit kompetensi berhasil diperbarui!');
            return redirect("/skema/$id/unit-kompetensi");
        } catch (Exception $e) {
            Session::flash('error', 'Gagal mengupdate unit kompetensi');
            return redirect("/skema/$id/unit-kompetensi");
        }
    }
}
