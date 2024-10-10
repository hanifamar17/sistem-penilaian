<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function siswaIndex(Request $request)
    {
        $siswa = Siswa::with(['kelas.waliKelas'])->get();

        return view('siswa/siswa-home', compact('siswa'));
    }

    public function siswaAdd()
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        
        return view('siswa.siswa-add', compact('siswa', 'kelas'));
    }

    public function siswaInsert(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'nis' =>  [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa'),
            ],
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'nullable',
        ]);

        // Membuat user baru dengan hashing password
        Siswa::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas_id,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('siswa-home')->with('success', 'Data berhasil ditambahkan!');
    }

    public function siswaDelete($id)
    {
        $siswa_delete = Siswa::find($id);
        $siswa_delete->delete();

        return redirect()->route('siswa-home')->with('delete', 'Data berhasil dihapus!');
    }

    public function siswaUpdateForm($id)
    {
        //$guru = Guru::where('id', $id) -> get();
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();

        return view('siswa.siswa-update-form', compact('siswa', 'kelas'));
    }

    public function siswaUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' =>  [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa')->ignore($id),
            ],
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'nullable',
        ]);

        $siswa = Siswa::findOrFail($id);

        $dataToUpdate = [
            'name' => $request->name ?? $siswa->name,
            'nis' => $request->nis ?? $siswa->nis,
            'tanggal_lahir' => $request->tanggal_lahir ?? $siswa->tanggal_lahir,
            'kelas_id' => $request->kelas_id ?? $siswa->kelas_id,
            'alamat' => $request->alamat ?? $siswa->alamat,
        ];

        $siswa->update($dataToUpdate);

        return redirect()->route('siswa-home')->with('updated', 'Data Berhasil Diperbarui');
    }

    public function siswaView($id)
    {
        //$mapel = Mapel::where('id', $id) -> get();
        //ambil nama wali kelas pada method kelas
        $siswa = Siswa::with(['kelas.waliKelas'])->where('id', $id)->get();

        return view('siswa.siswa-view', compact('siswa'));
    }

    //Filter kelas X
    public function siswaIndex1(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'X')->get();

        $siswa = Siswa::with(['kelas.waliKelas'])
            ->whereIn('kelas_id', $kelas->pluck('id'))
            ->get();

        return view('siswa/siswa-home1', compact('siswa', 'kelas'));
    }

    public function siswaFilterX(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'X')->get();

        // Inisialisasi variabel mapel
        $siswa = collect(); // Menggunakan collection kosong sebagai default

        // Ambil hasil filter jika ada kelas yang dipilih
        $selectedKelasId = $request->input('kelas_id');
        $filteredKelas = null;

        if ($selectedKelasId) {
            // Ambil data yang sudah difilter & ambil wali kelas pada method kelas
            $filteredKelas = Kelas::with('waliKelas')->where('id', $selectedKelasId)->first();

            $siswa = Siswa::with(['kelas.waliKelas'])
                ->where('kelas_id', $filteredKelas->id)
                ->get();
        }

        return view('siswa/siswa-filtered1', compact('siswa', 'kelas', 'filteredKelas'));
    }

    //Filter kelas XI
    public function siswaIndex2(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'XI')->get();

        $siswa = Siswa::with(['kelas.waliKelas'])
            ->whereIn('kelas_id', $kelas->pluck('id'))
            ->get();

        return view('siswa/siswa-home2', compact('siswa', 'kelas'));
    }

    public function siswaFilterXI(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'XI')->get();

        // Inisialisasi variabel mapel
        $siswa = collect(); // Menggunakan collection kosong sebagai default

        // Ambil hasil filter jika ada kelas yang dipilih
        $selectedKelasId = $request->input('kelas_id');
        $filteredKelas = null;

        if ($selectedKelasId) {
            // Ambil data yang sudah difilter & ambil wali kelas pada method kelas
            $filteredKelas = Kelas::with('waliKelas')->where('id', $selectedKelasId)->first();

            $siswa = Siswa::with(['kelas.waliKelas'])
                ->where('kelas_id', $filteredKelas->id)
                ->get();
        }

        return view('siswa/siswa-filtered2', compact('siswa', 'kelas', 'filteredKelas'));
    }

    //Filter kelas XII
    public function siswaIndex3(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'XII')->get();

        $siswa = Siswa::with(['kelas.waliKelas'])
            ->whereIn('kelas_id', $kelas->pluck('id'))
            ->get();

        return view('siswa/siswa-home3', compact('siswa', 'kelas'));
    }

    public function siswaFilterXII(Request $request)
    {
        $kelas = Kelas::where('tingkat', 'XII')->get();

        // Inisialisasi variabel mapel
        $siswa = collect(); // Menggunakan collection kosong sebagai default

        // Ambil hasil filter jika ada kelas yang dipilih
        $selectedKelasId = $request->input('kelas_id');
        $filteredKelas = null;

        if ($selectedKelasId) {
            // Ambil data yang sudah difilter & ambil wali kelas pada method kelas
            $filteredKelas = Kelas::with('waliKelas')->where('id', $selectedKelasId)->first();

            $siswa = Siswa::with(['kelas.waliKelas'])
                ->where('kelas_id', $filteredKelas->id)
                ->get();
        }

        return view('siswa/siswa-filtered3', compact('siswa', 'kelas', 'filteredKelas'));
    }
}
