<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAbsensi extends Model
{
    use HasFactory;
    protected $table = 'log_absensis';

    protected $fillable = ['id_siswa', 'tgl_absen', 'keterangan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
