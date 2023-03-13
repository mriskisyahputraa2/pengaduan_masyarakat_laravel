<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Petugas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    // tampilkan halaman index dashborad
    public function index()
    {
        // ambil / dapatakan semua data dan hitung data yang ada
        $petugas = Petugas::all()->count();

        $masyarakat = Masyarakat::all()->count();

        // proses data pengaduan yang status nya proses
        $proses = Pengaduan::where('status', 'proses')->get()->count();

        // jika sudah selesaikan data pengaduan yang statusnya selesai
        $selesai = Pengaduan::where('status', 'selesai')->get()->count();

        // kembailikan user ke halaman index dashboard, dengan value dibawah
        return view('Admin.Dashboard.index', ['petugas' => $petugas, 'masyarakat' => $masyarakat, 'proses' => $proses, 'selesai' => $selesai]);
    }
}
