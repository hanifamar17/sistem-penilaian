<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = ['siswa_id', 'mapel_id', 'ujian_id', 'nilai'];

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
