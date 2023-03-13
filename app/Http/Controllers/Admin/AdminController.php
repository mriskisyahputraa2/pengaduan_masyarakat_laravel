<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // menampilan formLogin petugas
    public function formLogin()
    {
        return view('Admin.login');
    }

    // pengecekan prose login petugas
    public function login(Request $request)
    {
        // ambil request dari model petugas berupa username
        $username = Petugas::where('username', $request->username)->first();

        // jika username tidak ada
        if(!$username){
            // maka beri pesan
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
        }

        // mengecek passwordnya sesuai yang di request oleh user dan acak passwordnya
        $password = Hash::check($request->password, $username->password);

        // jika password nya tidak ada
        if(!$password) {
            // maka beri pesan
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
        }

        // auth kan username dan password yang direquest
        $auth = Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password]);

        // maka cek jika auth berhasil
        if($auth){
            // maka bawa user kehalaman dashborad index
            return redirect()->route('dashboard.index');

            // jika gagal maka beri pesan 
        }else{
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar']);
        }
    }

    // logout
    public function logout(){

        // logout admin 
        Auth::guard('admin')->logout();

        // bawa user ke halaman form login
        return redirect()-route('admin.formLogin');
    }
}
