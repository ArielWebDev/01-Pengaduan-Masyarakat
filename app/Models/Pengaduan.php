<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';
    protected $fillable = ['masyarakat_id', 'judul', 'deskripsi', 'foto', 'status'];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class);
    }
    public function tanggapan() {
        return $this->hasOne(Tanggapan::class);
    }
    
}