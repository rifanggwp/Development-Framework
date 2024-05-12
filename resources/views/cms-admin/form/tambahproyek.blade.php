@extends('layouts.admin')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <div class="section-header-back">
        <a href="{{ route('cms-admin.data.proyek') }}" class="btn btn-icon"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <h1>Form Proyek</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Menu</a></div>
            <div class="breadcrumb-item"><a href="#">Form Tambah Proyek</a></div>
        </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Tambah Proyek</h2>
            <p class="section-lead">
                Lengkapi data berikut, untuk menambahkan proyek baru
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                            <div class="card-body">
                                <form action="{{ route('cms-admin.form.kirimdataproyek') }}" method="POST" enctype="multipart/form-data">
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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Layanan :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="Layanan" required>
                                            <option selected="true" disabled="disabled">--Pilih Layanan--</option>
                                            @foreach ($layanan as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Klien :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="Klien" required>
                                            <option selected="true" disabled="disabled">--Pilih Klien--</option>
                                            @foreach ($klien as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pekerja :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="Pekerja" required>
                                            <option selected="true" disabled="disabled">--Pilih Pekerja--</option>
                                            @foreach ($pekerja as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Proyek :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="hargaproyek" type="number" name="Harga" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan Tambahan Proyek:</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="Keterangan-Proyek" style="height: 150px;" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bukti Pembayaran</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="Bukti" class="form-control" required>
                                        <div class="form-text text-muted">Tipe/Format yang diizinkan .WEBP, .PNG, .JPG, .JPEG dengan maksimal ukuran 2MB</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan Pembayaran :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="Keterangan-Pembayaran" style="height: 100px;" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button id="submit" type="submit" class="btn btn-success">Kirim Data Proyek</button>
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