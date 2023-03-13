<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Petugas::create([
            'nama_petugas' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'telp' => '0852523434',
            'level' => 'admin'
        ]);
        \App\Models\Petugas::create([
            'nama_petugas' => 'Petugas',
            'username' => 'petugas',
            'password' => Hash::make('petugas'),
            'telp' => '0852523434',
            'level' => 'petugas'
        ]);
    }


}
