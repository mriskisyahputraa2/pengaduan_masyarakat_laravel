@extends('layouts.admin')

{{-- menggunakan cdn dari webiste datatable --}}
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endsection

@section('header', 'Data Pengaduan')

@section('content')
    <table id="pengaduanTable" class="table" >
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Isi Laporan</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $k => $v)
                <tr>
                    <td>{{ $k += 1 }}</td>
                    <td>{{ $v->tgl_pengaduan->format('d-M-Y') }}</td>
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
                    <td><a href="{{ route('pengaduan.show', $v->id_pengaduan) }}" style="text-decoration:underline">Lihat</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

{{-- menggunakan cdn dari webiste datatable --}}
@section('js')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js">

    $(document).ready(function () {
        $('#pengaduanTable').DataTable();
    });
@endsection