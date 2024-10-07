<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = ['tingkat', 'jurusan', 'nama_kelas',];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($kelas) {
            $kelas->nama_kelas = $kelas->tingkat . ' - ' . $kelas->jurusan;
        });

        static::updating(function ($kelas) {
            $kelas->nama_kelas = $kelas->tingkat . ' - ' . $kelas->jurusan;
        });
    }

}
