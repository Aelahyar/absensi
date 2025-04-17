<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'admins';

    protected $primaryKey = 'admins';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'aktif',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
