<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = ['siswa_id', 'mapel_id', 'ujian_id', 'kelas_id', 'akademik_id', 'nilai', 'rapor'];

    // Method untuk menghitung rata-rata nilai per siswa per mata pelajaran
    public static function hitungRapor($siswa_id, $mapel_id)
    {
        return self::where('siswa_id', $siswa_id)
            ->where('mapel_id', $mapel_id)
            ->avg('nilai'); // Menghitung rata-rata nilai
    }

    // fungsi untuk menghitung rata-rata semua mapel pada kelas yang diikuti siswa yang disimpan ke tabel rapor = insertRaport di RaporController
    protected static function booted()
    {
        static::saved(function ($nilai) {
            // Hitung rata-rata nilai
            $average = Nilai::where('siswa_id', $nilai->siswa_id)
                ->where('kelas_id', $nilai->kelas_id)
                ->avg('nilai');

            $kelas_id = $nilai->kelas_id;
            
            // Ambil data kelas untuk mendapatkan akademik_id dan wali_kelas_id
            $kelas = Kelas::with('waliKelas')->findOrFail($kelas_id);
            $wali_kelas_id = $kelas->waliKelas ? $kelas->waliKelas->id : null;
            $akademik_id = $kelas->akademik_id;

            $mapels = Mapel::where('kelas_id', $kelas_id)->get();

            // Update tabel rapor
            foreach ($mapels as $mapel) {
                Rapor::updateOrCreate(
                    [
                        'siswa_id' => $nilai->siswa_id,
                        'kelas_id' => $nilai->kelas_id,
                        'mapel_id' => $mapel->id,
                    ],
                    [
                        'rapor' => $average,
                        'wali_kelas_id' => $wali_kelas_id,
                        'akademik_id' => $akademik_id,  // Menyimpan akademik_id dari kelas
                        'catatan' => $catatan ?? null,  // Menyimpan catatan jika ada, null jika tidak
                    ]
                );
            }
        });
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function akademik()
    {
        return $this->belongsTo(Akademik::class);
    }
}
