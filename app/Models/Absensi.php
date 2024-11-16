<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'id_user', 'tanggal_absen', 'jam_masuk', 'jam_keluar', 'status' , 'note', 'photo'];
    public $timestamp = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
