@extends('layouts.user')

@section('css')
<style>
    body {
        background: #6a70fc;
    }

    .btn-purple {
        background: #6a70fc;
        width: 100%;
        color: #fff;
    }

</style>
@endsection

{{-- title halaman --}}
@section('title', 'Halaman Daftar')
{{-- end title halaman --}}

@section('content')

{{-- data register --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <h2 class="text-center text-white mb-0 mt-5">PEKAT</h2>
            <P class="text-center text-white mb-5">Pengaduan Masyarakat</P>
            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="text-center mb-5">FORM DAFTAR</h2>
                    <form action="{{ route('pekat.register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="number" name="nik" placeholder="NIK" class="form-control" autocomplete='off'>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control" autocomplete='off'>
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Username" class="form-control" autocomplete='off'>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control" autocomplete='off'>
                        </div>
                        <div class="form-group">
                            <input type="number" name="telp" placeholder="No. Telp" class="form-control" autocomplete='off'>
                        </div>
                        <button type="submit" class="btn btn-purple">REGISTER</button>
                    </form>
                </div>
            </div>

            {{-- memberi pesan --}}
            @if (Session::has('pesan'))
            <div class="alert alert-danger mt-2">
                {{ Session::get('pesan') }}
            </div>
            @endif
            {{-- end memberi pesan --}}
            <a href="{{ route('pekat.index') }}" class="btn btn-warning text-white mt-3" style="width: 100%">Kembali ke Halaman Utama</a>
        </div>
    </div>
</div>
{{-- data register --}}
@endsection
