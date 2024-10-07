<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'kelas_id', 'nama', 'nip'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
