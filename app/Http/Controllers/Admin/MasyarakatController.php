<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    // view masyarakat
    public function index(){
        // ambil semua data mansyarakat
        $masyarakat = Masyarakat::all();
        
        // dan tampilkan user kehalmaan index masyarakat dengan data masyarkat 
        return view('Admin.Masyarakat.index', ['masyarakat' => $masyarakat]);
    }

    // 
    public function show($nik)
    {
        $masyarakat = Masyarakat::where('nik', $nik)->first();

        return view('Admin.Masyarakat.show', ['masyarakat' => $masyarakat]);
    } 
}
