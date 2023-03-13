@extends('layouts.admin')

@section('title', 'Detail Masyarakat')
    
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
    <a href="{{ route('masyarakat.index') }}" class="text-primary">Data Masyarakat</a>
    <a href="#" class="text-gray">/</a>
    <a href="#" class="text-gray">Detail Masyarakat</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        Detail Masyarakat
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>NIK</th>
                                <td>:</td>
                                <td>{{ $masyarakat->nik }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td>{{ $masyarakat->nama }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>:</td>
                                <td>{{ $masyarakat->username }}</td>
                            </tr>
                            <tr>
                                <th>No Telp</th>
                                <td>:</td>
                                <td>{{ $masyarakat->telp }}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection