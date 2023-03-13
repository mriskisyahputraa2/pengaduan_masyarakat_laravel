<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    // view index
    public function index()
    {
        // tampilkan data petugas
        $petugas = Petugas::all(); 

        return view('Admin.Petugas.index', ['petugas' => $petugas]);
    }

    // 
    public function create()
    {
        return view('Admin.Petugas.create');
    }

    // 
    public function store(Request $request)
    {
        // ambil semua data yang direquest oleh petugas
        $data = $request->all();

        // membuat validate petuhas
        $validate = Validator::make($data, [
            'nama_petugas' => ['required', 'string', 'max:25'],
            'username' => ['required', 'string', 'unique:petugas'],
            'password' => ['required', 'string', 'min:6'],
            'telp' => ['required'],
            'level' => ['required', 'in:admin,petugas'],
        ]);

        // jika gagal
        if($validate->fails()){
            // maka beri pesan error validate
            return redirect()->back()->withErrors($validate);
        }

        // cari petugas berdasarkan usernemanya
        $username = Petugas::where('username', $data['username'])->first();


        // jika username nya ada maka beri pesan
        if($username){
            return redirect()->back()->with(['username' => 'Username sudah digunakan']);
        }

        // jika belom ada maka petugas akan dibuat
        Petugas::create([
            'nama_petugas' => $data['nama_petugas'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'level' => $data['level'],
        ]);

        // dan bawa user kehalaman petugas index
        return redirect()->route('petugas.index');
        
    }

    // method edit berdasarkan id_petugas
    public function edit($id_petugas)
    {
        // ambil data petugas berdasarkan id petugas
        $petugas = Petugas::where('id_petugas', $id_petugas)->first();

        // kembalikan user kehalaman petugas edit dengan value Petugas
        return view('Admin.Petugas.edit', ['petugas' => $petugas]);
    }

    // method updte berdasarakn request dari id petugas
    public function update(Request $request, $id_petugas)
    {
        // ambil semua datanya
        $data = $request->all();

        // find / pilih berdasarakan id_petugas
        $petugas = Petugas::find($id_petugas);

        // jika ada update dengan data baru
        $petugas->update([
            'nama_petugas' => $data['nama_petugas'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'level' => $data['level'],
        ]);

        // dan kembalikan ke petugas index
        return redirect()->route('petugas.index');
    } 

    // method hapus
    public function destroy ($id_petugas)
    {
        // ambil / pilih data petugas yang mau di hapus berdasarkan id 
        $petugas = Petugas::findOrFail($id_petugas);

        // delete datanya
        $petugas->delete();

        // kembalikan ke petugas index
        return redirect()->route('petugas.index');
    }
}
