<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akademik;

class AkademikController extends Controller
{
    public function akademikIndex(Request $request)
    {
        $akademik = Akademik::all();

        return view('akademik/akademik-home', compact('akademik'));
    }

    public function akademikAdd()
    {
        return view('akademik.akademik-add');
    }

    public function akademikInsert(Request $request){

        $request->validate([
            'semester' => 'required|string',
            'tahun_ajaran' => 'required|string',
        ]);

        Akademik::create([          
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        return redirect()->route('akademik-home')->with('success', 'Data berhasil ditambahkan!');
    }

    public function akademikDelete($id)
    {
        $akademik_delete = Akademik::find($id);
        $akademik_delete->delete();

        return redirect()->route('akademik-home')->with('delete', 'Data berhasil dihapus!');
    }

    public function akademikUpdateForm($id)
    {
        $akademik = Akademik::findOrFail($id);

        return view('akademik.akademik-update-form', compact('akademik'));
    }

    public function akademikUpdate(Request $request, $id)
    {
        $request->validate([
            'semester' => 'required|string',
            'tahun_ajaran' => 'required|string',
        ]);
        
        $akademik = Akademik::findOrFail($id);

        $dataToUpdate = [
            'semester' =>  $request->semester ?? $akademik->semester,
            'tahun_ajaran' =>  $request->tahun_ajaran ?? $akademik->tahun_ajaran,
        ];

        $akademik->update($dataToUpdate);

        return redirect()->route('akademik-home')->with('updated','Data Berhasil Diperbarui');
    }

    public function akademikView($id)
    {
        $akademik = Akademik::where('id', $id) -> get();

        return view('akademik.akademik-view', compact('akademik'));
    }
}
