<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\WaliKelas;

class MapelController extends Controller
{
    //MAPEL
    public function mapelIndex(Request $request)
    {
        $mapel = Mapel::with(['kelas.waliKelas'])->get();

        return view('admin/mapel-home', compact('mapel'));
    }

    public function mapelAdd()
    {
        $kelas = Kelas::all();
        $guru = Guru::all();
        return view('admin.mapel-add', compact('kelas', 'guru'));
    }

    public function mapelInsert(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'guru_id' => 'required|exists:guru,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        // Membuat user baru dengan hashing password
        Mapel::create([
            'name' => $request->name,
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('mapel-home')->with('success', 'Data berhasil ditambahkan!');
    }

    public function mapelDelete($id)
    {
        $mapel_delete = Mapel::find($id);
        $mapel_delete->delete();

        return redirect()->route('mapel-home')->with('delete', 'Data berhasil dihapus!');
    }

    public function mapelUpdateForm($id)
    {
        //$guru = Guru::where('id', $id) -> get();
        $mapel = Mapel::findOrFail($id);
        $kelas = Kelas::all();
        $guru = Guru::all();

        return view('admin.mapel-update-form', compact('mapel', 'kelas', 'guru'));
    }

    public function mapelUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'guru_id' => 'required|exists:guru,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $mapel = Mapel::findOrFail($id);

        $dataToUpdate = [
            'name' => $request->name ?? $mapel->name,
            'guru_id' => $request->guru_id ?? $mapel->guru_id,
            'kelas_id' => $request->kelas_id ?? $mapel->kelas_id,
        ];

        $mapel->update($dataToUpdate);

        return redirect()->route('mapel-home')->with('updated', 'Data Berhasil Diperbarui');
    }

    public function mapelView($id)
    {
        //$mapel = Mapel::where('id', $id) -> get();
        //ambil nama wali kelas pada method kelas
        $mapel = Mapel::with(['kelas.waliKelas'])->where('id', $id)->get();

        return view('admin.mapel-view', compact('mapel'));
    }

    //Filter kelas X
    public function mapelIndex1(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'X')->get();

        $mapel = Mapel::with(['kelas', 'guru', 'kelas.waliKelas'])
            ->whereIn('kelas_id', $kelas->pluck('id'))
            ->get();

        return view('mapel/mapel-home1', compact('mapel', 'kelas'));
    }

    public function mapelFilterX(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'X')->get();

        // Inisialisasi variabel mapel
        $mapel = collect(); // Menggunakan collection kosong sebagai default

        // Ambil hasil filter jika ada kelas yang dipilih
        $selectedKelasId = $request->input('kelas_id');
        $filteredKelas = null;

        if ($selectedKelasId) {
            // Ambil data yang sudah difilter & ambil wali kelas pada method kelas
            $filteredKelas = Kelas::with('waliKelas')->where('id', $selectedKelasId)->first();

            $mapel = Mapel::with(['guru', 'kelas.waliKelas'])
                ->where('kelas_id', $filteredKelas->id)
                ->get();
        }

        return view('mapel/mapel-filtered1', compact('mapel', 'kelas', 'filteredKelas'));
    }

    //Filter kelas XI
    public function mapelIndex2(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'XI')->get();

        $mapel = Mapel::with(['kelas', 'guru', 'kelas.waliKelas'])
            ->whereIn('kelas_id', $kelas->pluck('id'))
            ->get();

        return view('mapel/mapel-home2', compact('mapel', 'kelas'));
    }

    public function mapelFilterXI(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'XI')->get();

        // Inisialisasi variabel mapel
        $mapel = collect(); // Menggunakan collection kosong sebagai default

        // Ambil hasil filter jika ada kelas yang dipilih
        $selectedKelasId = $request->input('kelas_id');
        $filteredKelas = null;

        if ($selectedKelasId) {
            // Ambil data yang sudah difilter & ambil wali kelas pada method kelas
            $filteredKelas = Kelas::with('waliKelas')->where('id', $selectedKelasId)->first();

            $mapel = Mapel::with(['guru', 'kelas.waliKelas'])
                ->where('kelas_id', $filteredKelas->id)
                ->get();
        }

        return view('mapel/mapel-filtered2', compact('mapel', 'kelas', 'filteredKelas'));
    }

    //Filter kelas XII
    public function mapelIndex3(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'XII')->get();

        $mapel = Mapel::with(['kelas', 'guru', 'kelas.waliKelas'])
            ->whereIn('kelas_id', $kelas->pluck('id'))
            ->get();

        return view('mapel/mapel-home3', compact('mapel', 'kelas'));
    }

    public function mapelFilterXII(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'XII')->get();

        // Inisialisasi variabel mapel
        $mapel = collect(); // Menggunakan collection kosong sebagai default

        // Ambil hasil filter jika ada kelas yang dipilih
        $selectedKelasId = $request->input('kelas_id');
        $filteredKelas = null;

        if ($selectedKelasId) {
            // Ambil data yang sudah difilter & ambil wali kelas pada method kelas
            $filteredKelas = Kelas::with('waliKelas')->where('id', $selectedKelasId)->first();

            $mapel = Mapel::with(['guru', 'kelas.waliKelas'])
                ->where('kelas_id', $filteredKelas->id)
                ->get();
        }

        return view('mapel/mapel-filtered3', compact('mapel', 'kelas', 'filteredKelas'));
    }
}
