<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;

    protected $table = 'wali_kelas';

    protected $fillable = ['kelas_id', 'nama', 'nip', 'email', 'password', 'role'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
