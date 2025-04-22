<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'nis',
        'nama_siswa',
        'tempat_lahir',
        'tgl_lahir',
        'jk',
        'alamat',
        'status',
        'th_angkatan',
        'id_mkelas'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_mkelas');
    }
}
