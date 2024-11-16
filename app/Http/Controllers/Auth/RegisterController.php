<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nama_pegawai' => $data['nama_pegawai'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'tanggal_masuk' => $data['tanggal_masuk'],
            'email' => $data['email'],
            'umur' => $data['umur'],
            'gaji' => $data['gaji'],
            'status_pegawai' => 0,
            'id_jabatan' => $data['id_jabatan'],
            'is_admin' => 0,
            'google_id' => null,
            'is_admin' => 0,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        // Validasi input dari user
        $this->validator($request->all())->validate();

        // Buat user tapi jangan login
        $this->create($request->all());

        // Redirect ke halaman login dengan pesan
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login kembali.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_pegawai' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'tanggal_masuk' => ['required', 'date'],
            'umur' => ['required', 'integer'],
            'gaji' => ['required', 'integer'],
            'id_jabatan' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
