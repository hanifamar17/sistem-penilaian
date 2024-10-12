<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Akademik;
use Illuminate\Validation\Rule;

class UjianController extends Controller
{
    //UJIAN
    public function ujianIndex(Request $request)
    {
        $ujian = Ujian::with('akademik')->get();

        return view('ujian/ujian-home', compact('ujian'));
    }

    public function ujianAdd()
    {
        $akademik = Akademik::all();

        return view('ujian.ujian-add', compact('akademik'));
    }

    public function ujianInsert(Request $request){

        $request->validate([
            'name' => 'required|string',
            'akademik_id' => 'required|exists:akademik,id',
        ]);

        // Membuat user baru dengan hashing password
        Ujian::create([
            'name' => $request->name,
            'akademik_id' => $request->akademik_id,
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
        $akademik = Akademik::All();

        return view('ujian.ujian-update-form', compact('ujian'));
    }

    public function ujianUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'akademik_id' => 'required|exists:akademik,id',
        ]);
        
        $ujian = Ujian::findOrFail($id);

        $dataToUpdate = [
            'name' => $request->name ?? $ujian->name, 
            'akademik_id' => $request->akademik_id ?? $ujian->akademik_id,
        ];

        $ujian->update($dataToUpdate);

        return redirect()->route('ujian-home')->with('updated','Data Berhasil Diperbarui');
    }

    public function ujianView($id)
    {
        $ujian = Ujian::with('akademik') -> where('id', $id) -> get();

        return view('ujian.ujian-view', compact('ujian'));
    }
}
