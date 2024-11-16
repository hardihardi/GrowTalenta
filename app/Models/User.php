<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pegawai',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'tanggal_masuk',
        'umur',
        'gaji',
        'status_pegawai',
        'google_id',
        'email',
        'email_verified_at',
        'password',
        'is_admin',
        'id_jabatan',
        'provinsi',
        'kota',
        'kabupaten',
        'kecamatan',
        'kelurahan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function penggajian()
    {
        return $this->hasMany(Penggajian::class, 'id_user');
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_user');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
    public function cuti()
    {
        return $this->hasMany(Cutis::class, 'id_user');
    }
    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'id_user');
    }
}
