<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'id_user', 'tanggal_gaji', 'jumlah_gaji', 'bonus', 'potongan'];
    public $timestamp = true;

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
