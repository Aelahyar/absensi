<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    protected $table = 'tb_walikelas';
    protected $primaryKey = 'id_walikelas';
    public $timestamps = false;
    protected $fillable = ['id_guru', 'id_mkelas'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_mkelas');
    }
}
