<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Masyarakat;

class Pengaduan extends Authenticatable
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $primaryKey = 'id_pengaduan';
    protected $fillable = [
        'tgl_pengaduan',
        'nik',
        'isi_laporan',
        'foto',
        'status'
    ];

    protected $dates = ['tgl_pengaduan'];

    public function user() {
        return $this->hasOne(Masyarakat::class, 'nik', 'nik');
    }
}
