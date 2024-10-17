<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Rapor;

class RaporController extends Controller
{
    public function raporIndex()
    {
        $kelas = Kelas::with('WaliKelas', 'akademik')->get();

        return view('rapor/rapor-home', compact('kelas'));
    }

    public function showSiswa($kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $siswaList = Siswa::where('kelas_id', $kelas_id)->get(); // Ambil ID siswa berdasarkan kelas
        $mapelList = Mapel::where('kelas_id', $kelas_id)->get(); // Ambil mapel berdasarkan kelas

        // Menentukan status untuk setiap siswa
        $siswaStatus = $siswaList->map(function ($siswa) use ($mapelList) {
            $status = 'Completed'; // Default status

            // Cek nilai untuk setiap mapel
            foreach ($mapelList as $mapel) {
                $nilai = Nilai::where('siswa_id', $siswa->id)
                    ->where('mapel_id', $mapel->id)
                    ->first();

                // Jika ditemukan nilai null, set status ke 'In-Progress'
                if ($nilai === null || $nilai->nilai === null) {
                    $status = 'In-Progress';
                    break; // Tidak perlu memeriksa mapel lain jika sudah ada nilai null
                }
            }

            return [
                'siswa' => $siswa,
                'status' => $status
            ];
            
        });

        return view('rapor/rapor-siswa', compact('siswaStatus', 'kelas'));
    }

    public function showRapor(Request $request)
    {
        $siswa_id = $request->input('siswa_id');
        $kelas_id = $request->input('kelas_id');

        // Ambil siswa berdasarkan siswa_id dan kelas_id
        $siswa = Siswa::findOrFail($siswa_id);
        // Ambil kelas untuk mendapatkan nama kelas
        $kelas = Kelas::with('waliKelas')->findOrFail($kelas_id);
        // Ambil mata pelajaran yang diikuti siswa di kelas tersebut
        $mapels = Mapel::with('guru')->where('kelas_id', $kelas_id)->get(); // Ambil mata pelajaran berdasarkan kelas_id

        // Ambil nilai untuk siswa tersebut
        $nilai = Nilai::where('siswa_id', $siswa_id)
            ->where('kelas_id', $kelas_id)
            ->get()
            ->keyBy('mapel_id');

        // Ambil data rapor siswa dari database, jika ada
        $rapor = Rapor::where('siswa_id', $siswa_id)
            ->where('kelas_id', $kelas_id)
            ->first();  // ambil 1 record rapor

        return view('rapor/rapor-view', compact('mapels', 'nilai', 'siswa', 'kelas', 'kelas_id', 'rapor'));
    }

    public function insertRapor(Request $request)
    {
        // Validasi data yang diperlukan
        $request->validate([
            'siswa_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
        ]);

        // Ambil input data dari form
        $siswa_id = $request->input('siswa_id');
        $kelas_id = $request->input('kelas_id');
        $mapel_id = $request->input('mapel_id');
        $rapor = floatval($request->input('rapor'));  // Pastikan nilai rapor sebagai float
        $catatan = $request->input('catatan');  // Catatan bisa null

        // Ambil wali kelas dari kelas yang dipilih
        $kelas = Kelas::with('waliKelas')->findOrFail($kelas_id);
        $wali_kelas_id = $kelas->waliKelas ? $kelas->waliKelas->id : null;

        // Ambil semua mapel yang ada di kelas ini
        $mapels = Mapel::where('kelas_id', $kelas_id)->get();

        foreach ($mapels as $mapel) {
            // Simpan/update ke dalam tabel rapor
            Rapor::updateOrCreate(
                [
                    'siswa_id' => $siswa_id,
                    'kelas_id' => $kelas_id,
                    'mapel_id' => $mapel->id,  // Update untuk setiap mapel_id
                ],
                [
                    'wali_kelas_id' => $wali_kelas_id,
                    'akademik_id' => $kelas->akademik_id,  // Menyimpan akademik_id dari kelas
                    'catatan' => $catatan ?? null,  // Menyimpan catatan jika ada, null jika tidak
                ]
            );
        }

        return redirect()->route('rapor-view', ['siswa_id' => $siswa_id, 'kelas_id' => $kelas_id])->with('success', 'Rapor berhasil disimpan');
    }
}
