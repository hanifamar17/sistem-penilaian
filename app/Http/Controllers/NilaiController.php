<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Ujian;
use App\Models\Kelas;
use App\Models\WaliKelas;
use Illuminate\Validation\Rule;

class NilaiController extends Controller
{
    //Nilai
    public function nilaiIndex(Request $request)
    {
        $kelas = Kelas::with('WaliKelas')->get();

        return view('nilai/nilai-home', compact('kelas'));
    }

    public function nilaiMapel($kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id); // Cari kelas berdasarkan id
        $mapel = Mapel::where('kelas_id', $kelas_id)->get(); // Ambil mapel dari kelas

        return view('nilai.nilai-mapel', compact('kelas', 'mapel'));
    }

    public function nilaiSiswa($kelas_id, $mapel_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $mapel = Mapel::findOrFail($mapel_id);
        $siswa = Siswa::where('kelas_id', $kelas_id)->get(); // Ambil siswa dari kelas
        $ujian = Ujian::all();

        // Ambil nilai yang sudah ada
        $nilai_existing = Nilai::where('mapel_id', $mapel_id)
            ->whereIn('siswa_id', $siswa->pluck('id'))
            ->get()
            ->keyBy(function ($item) {
                return $item['siswa_id'] . '-' . $item['ujian_id'];
            });

        //dd($ujian);
        return view('nilai.nilai-siswa', compact('kelas', 'mapel', 'siswa', 'ujian', 'nilai_existing'));
    }

    public function nilaiInsert(Request $request, $kelas_id, $mapel_id)
    {
        $nilai_data = $request->input('nilai');

        foreach ($nilai_data as $siswa_id => $nilai_per_ujian) {
            foreach ($nilai_per_ujian as $ujian_id => $nilai) {
                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswa_id,
                        'mapel_id' => $mapel_id,
                        'ujian_id' => $ujian_id,
                    ],
                    [
                        'nilai' => $nilai,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
