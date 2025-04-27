<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mengajar extends Model
{
    use HasFactory;
    protected $table = 'mengajars';
    protected $primaryKey = 'id_mengajar';
    protected $fillable = [
        'kode',
        'hari',
        'waktu',
        'jamke',
        'id_guru',
        'id_mapel',
        'id_mkelas',
        'id_semester',
        'id_thajaran',
    ];

    // Relasi
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
        return $this->belongsTo(Kelas::class, 'id_mkelas', 'id_mkelas');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id_semester');
    }

    public function thAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_thajaran', 'id_thajaran');
    }
}
