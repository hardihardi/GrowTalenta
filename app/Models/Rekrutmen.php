<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekrutmen extends Model
{
    protected $fillable = ['id', 'nama', 'tanggal_lamaran', 'cv'];
    public $timestamp = true;
    use HasFactory;

    public function deleteCV()
    {
        if ($this->cv && file_exists(public_path('storage/cv/' . $this->cv))) {
            return unlink(public_path('storage/cv/' . $this->cv));
        }
    }
}
