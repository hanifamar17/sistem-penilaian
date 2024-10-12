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
        $kelas = Kelas::with('WaliKelas', 'akademik')->get();

        return view('nilai/nilai-home', compact('kelas'));
    }

    public function nilaiMapel($kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id); // Cari kelas berdasarkan id
        $mapelList = Mapel::where('kelas_id', $kelas_id)->get(); // Ambil mapel dari kelas
        $ujian = Ujian::all();
        $siswaList = Siswa::where('kelas_id', $kelas_id)->pluck('id'); // Ambil semua siswa di kelas ini 

        $mapelStatus = $mapelList->map(function ($mapel) use ($siswaList, $ujian) {

            $nilaiMapel = Nilai::where('mapel_id', $mapel->id)
                ->whereIn('siswa_id', $siswaList)
                ->get();

            $totalExpectedNilai = $siswaList->count() * $ujian->count(); // Hitung jumlah ujian yang diharapkan

            // Cek apakah semua nilai sudah diisi
            $nilaiNull = $nilaiMapel->contains(function ($item) {
                return is_null($item->nilai);
            });

            // Jika tidak ada nilai null dan jumlah nilai sesuai dengan yang diharapkan
            $status = (!$nilaiNull && $nilaiMapel->count() === $totalExpectedNilai) ? 'Completed' : 'On Progress';

            return [
                'mapel' => $mapel,
                'status' => $status
            ];
        });

        return view('nilai.nilai-mapel', compact('kelas', 'mapelStatus', 'ujian'));
    }

    public function nilaiSiswa($kelas_id, $mapel_id)
    {
        $kelas = Kelas::with('waliKelas')->findOrFail($kelas_id);
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
        $request->validate([
            'nilai.*.*' => 'required|numeric', // Validasi agar nilai bisa berupa angka, termasuk pecahan
        ]);

        $nilai_data = $request->input('nilai');

        // Ambil akademik_id dari kelas yang dipilih
        $kelas = Kelas::findOrFail($kelas_id);
        $akademik_id = $kelas->akademik_id;

        foreach ($nilai_data as $siswa_id => $nilai_per_ujian) {
            foreach ($nilai_per_ujian as $ujian_id => $nilai) {

                $nilai_float = floatval($nilai);
                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswa_id,
                        'mapel_id' => $mapel_id,
                        'ujian_id' => $ujian_id,
                    ],
                    [
                        'nilai' => $nilai_float,
                        'kelas_id' => $kelas_id,  // Menambahkan kelas_id
                        'akademik_id' => $akademik_id,  // Menambahkan akademik_id
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
