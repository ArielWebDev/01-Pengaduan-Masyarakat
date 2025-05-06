<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    use Notifiable;

    protected $table = 'masyarakats'; 
    protected $guard = 'masyarakat'; // Gunakan guard khusus

    protected $fillable = [
        'name', 'nomor_telpon', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}