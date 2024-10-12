<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademik extends Model
{
    use HasFactory;

    protected $table = 'akademik';

    // Kolom yang dapat diisi
    protected $fillable = [
        'name',
        'semester',
        'tahun_ajaran',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($akademik) {
            $akademik->name = $akademik->semester . ' / ' . $akademik->tahun_ajaran;
        });

        static::updating(function ($akademik) {
            $akademik->name = $akademik->semester . ' / ' . $akademik->tahun_ajaran;
        });
    }

    /**
     * Relasi satu ke banyak dengan Kelas.
     */
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    /**
     * Relasi satu ke banyak dengan Ujian.
     */
    public function ujian()
    {
        return $this->hasMany(Ujian::class);
    }

    /**
     * Relasi satu ke banyak dengan Nilai.
     */
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
