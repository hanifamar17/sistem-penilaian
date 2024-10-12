<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujian';

    protected $fillable = ['name', 'akademik_id'];

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }

    public function akademik()
    {
        return $this->belongsTo(Akademik::class);
    }
}
