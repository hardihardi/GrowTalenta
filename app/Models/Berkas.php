<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    protected $fillable = ['id', 'cv', 'kk', 'akte', 'ktp', 'id_user'];
    public $timestamp = true;
    use HasFactory;

    public function deleteCV()
    {
        if ($this->cv && file_exists(public_path('storage/cv/' . $this->cv))) {
            return unlink(public_path('storage/cv/' . $this->cv));
        }
    }

    public function deleteKK()
    {
        if ($this->kk && file_exists(public_path('storage/kk/' . $this->kk))) {
            return unlink(public_path('storage/kk/' . $this->kk));
        }
    }

    public function deleteKTP()
    {
        if ($this->ktp && file_exists(public_path('storage/ktp/' . $this->ktp))) {
            return unlink(public_path('storage/ktp/' . $this->ktp));
        }
    }

    public function deleteAKTE()
    {
        if ($this->akte && file_exists(public_path('storage/akte/' . $this->akte))) {
            return unlink(public_path('storage/akte/' . $this->akte));
        }
    }

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
