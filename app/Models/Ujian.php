<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujian';

    protected $fillable = ['name', 'semester', 'tahun_ajaran'];

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
}
