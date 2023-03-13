<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //
    public function index() 
    {
              // ambil data pengaduan berdasarkan colom dan urutkan dari data yang paling menurun / bawah
              $laporan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();

              // bawa user ke halaaman pengaduan dengan value pengaduan
              return view('Admin.Laporan.index', ['laporan' => $laporan]);
    }

    public function getLaporan(Request $request)
    {
        // buat waktu dari 00.00.00
        $from = $request->from . ' ' . '00:00:00';

        // sampai 
        $to = $request->to . ' ' . '23:59:59';

        // ambil data pengaduan kita seleksi waktu nya 
        $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();

        // kembalikan user ke laporan index dengan value
        return view('Admin.Laporan.index', ['pengaduan' => $pengaduan, 'from' => $from, 'to' => $to]);
    }

    public function cetakLaporan($from, $to)
    {
        // $pengaduan = Pengaduan::whereBetween('tgl_pengaduan', [$from, $to])->get();

        // $pdf = PDF::loadView('Admin.Laporan.cetak', ['pengaduan'=> $pengaduan]);

        // return $pdf->download('laporan-pengaduan.pdf');
    }
}
