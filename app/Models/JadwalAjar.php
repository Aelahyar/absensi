<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAjar extends Model
{
    use HasFactory;
    protected $table ="jadwal_ajars";
    protected $primaryKey = "id_mengajar";
    protected $fillable=[
        'id_mengajar',
        'kode_pelajaran',
        'hari',
        'jam_mengajar',
        'jamke',
        'id_guru',
        'id_mapel',
        'id_kelas',
        'id_semester',
        'id_thajaran',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_mkelas');
    }
}
