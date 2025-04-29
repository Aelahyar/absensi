<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPresensi extends Model
{
    use HasFactory;
    protected $table = 'log_presensis';

    protected $fillable = [
        'id_mengajar',
        'status',
        'tanggal'
    ];

    public function mengajar()
    {
        return $this->belongsTo(Mengajar::class, 'id_mengajar', 'id_mengajar');
    }
}
