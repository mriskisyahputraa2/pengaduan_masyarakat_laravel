@extends('layouts.admin')

@section('title', 'Halaman Laporan')

@section('header', 'Laporan Pengaduan')

@section('content')
    <div class="row">
        <button class="float-let btn-btn-primary" onclick="window.print();">EXPORT</button>
        <table id="pengaduanTable" class="table" >
            <thead>
                <tr>
                    <th>No</th>
                    <th>Isi Laporan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $k => $v)
                    <tr>
                        <td>{{ $k += 1 }}</td>
                        <td>{{ $v->isi_laporan }}</td>
                        <td>
                            @if ($v->status == '0')
                                <a href="#" class="text-danger">Pending</a>
                            @elseif ($v->status == 'proses')
                                <a href="#" class="text-warning">Proses</a>
                            @else
                                <a href="#" class="text-success">Selesai</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-header">
                    Data Berdasarkan Tanggal
                    <div class="float-right">
                        @if ($pengaduan ?? '')
                            <a href="{{ route('laporan.cetakLaporan', ['from' => $from, 'to' => $to]) }}" class="btn btn-danger">EXPORT PFD</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if ($pengaduan ?? '')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Isi Laporan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduan as $k =>$v )
                                    <tr>
                                        <td>{{ $k += 1 }}</td>
                                        <td>{{ $v->tgl_pengaduan }}</td>
                                        <td>{{ $v->isi_laporan }}</td>
                                        <td>
                                            @if ($v->status == '0')
                                                <a href="#" class="text-danger">Pending</a>
                                            @elseif ($v->status == 'proses')
                                                <a href="#" class="text-warning">Proses</a>
                                            @else
                                                <a href="#" class="text-success">Selesai</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">
                            Tidak ada data
                        </div>
                    @endif
                </div>
            </div>
        </div> --}}
    </div>
@endsection