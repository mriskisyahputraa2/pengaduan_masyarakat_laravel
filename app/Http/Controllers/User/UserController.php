<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    // menampilkan halaman landing
    public function index()
    {
        return view('user.landing');
    }

    // proses login
    public function login(Request $request)
    {
        // mengecek apakah ada data yang didalamn tabel masyarakat
        $username = Masyarakat::where('username', $request->username)->first();

        // jika tidak beri pesan 
        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
        }

        // mengecek apakah password yang di request sama tidak dengan password yang di tabel masyarakat
        $password = Hash::check($request->password, $username->password);

        // jika tidak sesuai maka beri pesan
        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
        }

        // trs check validasi user dan pass yang di masukkan oleh masyarakat dan samakan di database
        if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // kembalikan kehalaaman utama
            return redirect()->back();

            // jika gagal beri pesan
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }

    // membewa user kehalaman register
    public function formRegister()
    {
        return view('user.register');
    }

    // validasi & proses register
     public function register(Request $request)
    {
        // mengambil semua data
        $data = $request->all();

        // melakukan validasi
        $validate = Validator::make($data, [
            'nik' => ['required'],
            'nama' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'telp' => ['required'],
        ]);

        // jika gagal akan menampilakn pesan 
        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        // mengecek apakah username sudah ada di tabel masyarakat
        $username = Masyarakat::where('username', $request->username)->first();

        // jika sudah berikan pesan 
        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username sudah terdaftar']);
        }

        // jika data blm, ada disini proses create data masyarakat
        Masyarakat::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']), // untuk password akan di acak
            'telp' => $data['telp'],
        ]);

        // kembalikan ke index 
        return redirect()->route('pekat.index');
    }

    // logout Masyarakat
    public function logout()
    {
        Auth::guard('masyarakat')->logout();

        return redirect()->back();
    }

    // menulis pengaduan
    public function storePengaduan(Request $request)
    {
        // jika masyarakat belm punya akun dan ingin langsung mengisikan pengaduan
        if (!Auth::guard('masyarakat')->user()) {
            //  maka tampilakan pesan
            return redirect()->back()->with(['pesan' => 'Login dibutuhkan!'])->withInput();
        }

        // jika sudah login, ambil request yang disi oleh masyarkat
        $data = $request->all();

        // validasi laporan
        $validate = Validator::make($data, [
            'isi_laporan' => ['required'],
        ]);

        // jika validasi gagal 
        if ($validate->fails()) {
            // maka beritahu bahwa validasi error
            return redirect()->back()->withInput()->withErrors($validate);
        }

        // jika foto ada
        if ($request->file('foto')) {
            // maka simpan kedalam folder assets asset, pengaduan didalam public
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        }

        // waktu defaulny di asia/bangkok
        date_default_timezone_set('Asia/Bangkok');

        // prosps membuat pengaduan
        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d h:i:s'), // Y adalah tahun, m adalah bulan, d adalah hari dan h:i:s adalah jam menit dan detik
            'nik' => Auth::guard('masyarakat')->user()->nik, // nik diambil untuk masyarakat yang isi pengaduan
            'isi_laporan' => $data['isi_laporan'],
            'foto' => $data['foto'] ?? '', // jika fotonya ada maka akan tampil, jika tidak maka akan menampilkan string kosong
            'status' => '0', // defaulnya 0
        ]);

        // jika berhasil 
        if ($pengaduan) {
            // maka tampilakn pesan
            return redirect()->route('pekat.laporan', 'me')->with(['pengaduan' => 'Berhasil terkirim!', 'type' => 'success']);
        // jika gagal tampilakan pesan
        } else {
            return redirect()->back()->with(['pengaduan' => 'Gagal terkirim!', 'type' => 'danger']);
        }
    }

    // laporan
    public function laporan($siapa = '') // parameternya dari siapa dan defaulnya adalah kosong / null
    {
        // melaukan verifikasi dari pengdauan yang diisi dari masyarakat yang diambil dari nik ketika sedang login dan status nya tidak boleh 0  
        $terverifikasi = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->get()->count();
        
        // melakukan proses dari pengaduan yang diisi oleh masyarakat  dan status nya proses
        $proses = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'proses']])->get()->count();

        // melakukan finalisasi dari pengaduan yang diisi oleh masyarakat  dan status nya selesai
        $selesai = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'selesai']])->get()->count();

        // variabel di atas akan di masukkan menjadi array
        $hitung = [$terverifikasi, $proses, $selesai];

        // jika laporan nya ada isinya
        if ($siapa == 'me') {

            // maka jalankan model pengaduan yang diamabil dari masyarakat berupa nik tgl pengaduan dan di deskending
            $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->orderBy('tgl_pengaduan', 'desc')->get();

            // dan bawa user kehalman laporan dan hitung pengaduannya berdasakan pengaduan yang masuk dari siapa
            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);

        //  jika parameter siapa diisi kosong 
        } else {
            // maka jalankan pengaduan dan kondisi nya berdasarkan nik dari masyarakat kemudaian statusnya tidak boleh 0 dan ordeBy berdaskaran tgl_pengaduan 
            $pengaduan = Pengaduan::where([['nik', '!=', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->orderBy('tgl_pengaduan', 'desc')->get();

            // maka user akan di bawa kehalam laporan
            return view('user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        }
    }
}
