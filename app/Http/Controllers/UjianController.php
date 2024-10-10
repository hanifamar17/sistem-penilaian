<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use Illuminate\Validation\Rule;

class UjianController extends Controller
{
    //UJIAN
    public function ujianIndex(Request $request)
    {
        $ujian = Ujian::all();

        return view('ujian/ujian-home', compact('ujian'));
    }

    public function ujianAdd()
    {
        return view('ujian.ujian-add');
    }

    public function ujianInsert(Request $request){

        $request->validate([
            'name' => 'required|string',
            'semester' => 'required|string',
            'tahun_ajaran' => 'required|string',
        ]);

        // Membuat user baru dengan hashing password
        Ujian::create([
            'name' => $request->name,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect()->route('ujian-home')->with('success', 'Data berhasil ditambahkan!');
    }

    public function ujianDelete($id)
    {
        $ujian_delete = Ujian::find($id);
        $ujian_delete->delete();

        return redirect()->route('ujian-home')->with('delete', 'Data berhasil dihapus!');
    }

    public function ujianUpdateForm($id)
    {
        $ujian = Ujian::findOrFail($id);

        return view('ujian.ujian-update-form', compact('ujian'));
    }

    public function ujianUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'semester' => 'required|string',
            'tahun_ajaran' => 'required|string',
        ]);
        
        $ujian = Ujian::findOrFail($id);

        $dataToUpdate = [
            'name' => $request->name ?? $ujian->name, 
            'semester' =>  $request->semester ?? $ujian->semester,
            'tahun_ajaran' =>  $request->tahun_ajaran ?? $ujian->tahun_ajaran,
        ];

        $ujian->update($dataToUpdate);

        return redirect()->route('ujian-home')->with('updated','Data Berhasil Diperbarui');
    }

    public function ujianView($id)
    {
        $ujian = Ujian::where('id', $id) -> get();

        return view('ujian.ujian-view', compact('ujian'));
    }
}
