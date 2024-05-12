@extends('layouts.admin')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('cms-admin.data.klien') }}" class="btn btn-icon"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <h1>Form Klien</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Menu</a></div>
            <div class="breadcrumb-item"><a href="#">Form Edit Klien</a></div>
        </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Edit Klien</h2>
            <p class="section-lead">
                Lengkapi data berikut, untuk memperbarui data Klien Anda
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                            <div class="card-body">
                            @foreach($detailklien as $data)
                                <form action="{{ route('cms-admin.data.detail.klien.updateklien', $data->id_klien) }}" method="POST" enctype="multipart/form-data">
                                @method('PATCH')
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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Klien :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="namaklien" type="text" name="Nama" class="form-control" value="{{ $data->nama_klien ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email Klien :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="emailklien" type="email" name="Email" class="form-control" value="{{ $data->email_klien ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Telepon Klien :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="teleponklien" type="number" name="Telepon" class="form-control" value="{{ $data->no_telp_klien ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat Klien :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="alamatklien" type="text" name="Alamat" class="form-control" value="{{ $data->alamat_klien ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button id="submit" type="submit" class="btn btn-success">Update Data Klien</button>
                                </div>
                            </div>
                            </form>                            
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection