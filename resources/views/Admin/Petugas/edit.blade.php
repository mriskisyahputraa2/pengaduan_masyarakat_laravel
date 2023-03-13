@extends('layouts.admin')

@section('title', 'Form Tambah Petugas')

@section('css')
    <style>
        .text-primary:hover{
            text-decoration: underline;
        }
        .text-gray{
            color: #6c757d;
        }
        .text-gray:hover{
            color: #6c757d;
        }
   
    </style>
@endsection

@section('header')
    <a href="{{ route('petugas.index') }}" class="text-primary">Edit Petugas</a>
    <a href="#" class="text-gray">/</a>
    <a href="#" class="text-gray">Form Edit Petugas</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Edit Petugas
                </div>
                <div class="card-body">
                    <form action="{{ route('petugas.update', $petugas->id_petugas) }}" method="POST">
                        @csrf
                        {{-- karna form cuma support get dan post, buat method pacth(edit)--}}
                        @method('PATCH')
                        <div class="form-group">
                            <label for="nama_petugas">Nama Petugas</label>
                            <input type="text" name="nama_petugas" value="{{ $petugas->nama_petugas }}" id="nama_petugas" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="{{ $petugas->username }}" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">No Telp</label>
                            <input type="number" name="telp" value="{{ $petugas->telp }}" id="telp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <div class="input-group mb-3">
                                <select name="level" id="level" class="custom-select">
                                    
                                    {{-- jika level petugas sama dengan admin --}}
                                    @if ($petugas->level == 'admin') 
                                    
                                        {{-- kalo benar, maka levelnya sebagai admin --}}
                                        <option selected value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>

                                    @else
                                        {{-- kalo tidak, maka levelnya sebagai petugas --}}
                                        <option value="admin">Admin</option>
                                        <option selected value="petugas">Petugas</option>

                                    @endif

                                </select>    
                            </div>    
                        </div>
                        <button type="submit" class="btn btn-warning text-white" style="width: 100% ">UPDATE</button>
                    </form>
                    <form action="{{ route('petugas.destroy', $petugas->id_petugas) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2 w-100">HAPUS</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endsection