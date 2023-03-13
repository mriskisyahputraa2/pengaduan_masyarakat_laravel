<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    // method create or update
    public function createOrUpdate(Request $request)
    {
        // ambil data pengaduan berdasarkan id
        $pengaduan = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();

        // ambil data tanggapan berdasarkan id
        $tanggapan = Tanggapan::where('id_pengaduan', $request->id_pengaduan)->first();

        // cek jika tanggapan ada
        if($tanggapan) {
            // maka update status pengaduan
            $pengaduan->update(['status' => $request->status]);

            // dan update
            $tanggapan->update([
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan,
                'id_tanggapan' => Auth::guard('admin')->user()->id_petugas,
            ]);

            // bawa user ke pengaduan dengan membawa data pengaduan dan tanggapan
            return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan', $tanggapan]);
        
        // jika tidak ada
        }else{
            // maka tetap update status pengaduan
            $pengaduan->update(['status' => $request->status]);

            // dan buat data tanggapannya
            $tanggapan = Tanggapan::create([
                'id_pengaduan' => $request->id_pengaduan,
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $request->tanggapan,
                // disini masih error
                'id_tanggapan' => Auth::guard('admin')->user()->id_petugas,
                'id_petugas' => Auth::guard('admin')->user()->id_petugas,
            ]);

            // kembalikan user ke route pengaduan dengan value 
            return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil Dikirim']);
        }
    }
}
