<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    //
    public function index()
    {
        // ambil data pengaduan berdasarkan colom dan urutkan dari data yang paling menurun / bawah
        $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();

        // bawa user ke halaaman pengaduan dengan value pengaduan
        return view('Admin.Pengaduan.index', ['pengaduan' => $pengaduan]);
    }

    
    public function show($id_pengaduan)
    {
        // ambil data pengdauan berdasarkan id_pengaduan 
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        //
        $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();

        return view('Admin.Pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan]);
    }
}
