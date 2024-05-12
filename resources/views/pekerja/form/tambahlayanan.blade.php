@extends('layouts.admin')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <div class="section-header-back">
        <a href="{{ route('cms-admin.data.layanan') }}" class="btn btn-icon"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <h1>Form Layanan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Menu</a></div>
            <div class="breadcrumb-item"><a href="#">Form Tambah Layanan</a></div>
        </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Tambah Layanan</h2>
            <p class="section-lead">
                Lengkapi data berikut, untuk menambahkan layanan baru
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                            <div class="card-body">
                                <form action="{{ route('cms-admin.form.kirimdatalayanan') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Layanan :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="namalayanan" type="text" name="Nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan Layanan :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="Keterangan" style="height: 250px;" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto Layanan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="Foto" class="form-control" required>
                                        <div class="form-text text-muted">Tipe/Format yang diizinkan .WEBP, .PNG, .JPG, .JPEG dengan maksimal ukuran 1MB</div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button id="submit" type="submit" class="btn btn-success">Kirim Data Layanan</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection