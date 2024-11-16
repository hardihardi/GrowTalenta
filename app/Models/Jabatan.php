<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama_jabatan'];
    public $timestamp = true;

    public function pegawai()
    {
        return $this->hasMany(User::class, 'id_jabatan');
    }
}
