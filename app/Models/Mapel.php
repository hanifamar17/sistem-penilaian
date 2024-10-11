<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';

    protected $fillable = ['name', 'kelas_id', 'guru_id',];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
