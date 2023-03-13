@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

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
        .btn-purple{
            background: #6c757d;
            border: 1px solid #6c757d;
            color: #fff;
            width: 100%;
        }
    </style>
@endsection

@section('header')
    <a href="{{ route('pengaduan.index') }}" class="text-primary">Data Pengaduan</a>
    <a href="#" class="text-gray">/</a>
    <a href="#" class="text-gray">Detail Pengaduan</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        Pengaduan Masyarakat
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>NIK</th>
                                <th>:</th>
                                <th>{{ $pengaduan->nik }}</th>
                            </tr>
                            <tr>
                                <th>Tanggap Pengaduan</th>
                                <th>:</th>
                                <th>{{ $pengaduan->tgl_pengaduan }}</th>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <th>:</th>
                                <th><img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Pengaduan" class="embed-responsive"></th>
                            </tr>
                            <tr>
                                <th>Isi Laporan</th>
                                <th>:</th>
                                <th>{{ $pengaduan->isi_laporan }}</th>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th>:</th>
                                <th>
                                    @if ($pengaduan->status == '0')
                                        <a href="#" class="text-danger">Pending</a>
                                    @elseif ($pengaduan->status == 'proses')
                                        <a href="#" class="text-warning">Proses</a>
                                    @else
                                        <a href="#" class="text-success">Selesai</a>
                                    @endif
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        Tanggapan Petugas
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('tanggapan.createOrUpdate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pengaduan" value="{{ $pengaduan->id_pengaduan }}">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="input-group mb-3">
                                <select name="status" id="status" class="custom-select">
                                    @if ($pengaduan->status == '0')
                                    <option selected value="0">Pending</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                    @elseif ($pengaduan->status == 'proses')
                                    <option value="0">Pending</option>
                                    <option selected value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                    @else
                                    <option value="0">Pending</option>
                                    <option value="proses">Proses</option>
                                    <option selected value="selesai">Selesai</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggapan">Tanggapan</label>
                            <textarea name="tanggapan" id="tanggapan" class="form-control" placeholder="Belum ada tanggapan">{{ $tanggapan->tanggapan ?? ''}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-purple">KIRIM</button>
                    </form>
                    @if (Session::has('status'))
                        <div class="alert alert-success mt-2">
                            {{ Session::get('status') }}
                        </div>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection