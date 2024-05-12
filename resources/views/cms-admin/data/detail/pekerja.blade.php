@extends('layouts.admin')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('cms-admin.data.pekerja') }}" class="btn btn-icon"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <h1>Form Pekerja</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Menu</a></div>
            <div class="breadcrumb-item"><a href="#">Form Edit Pekerja</a></div>
        </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Edit Pekerja</h2>
            <p class="section-lead">
                Lengkapi data berikut, untuk memperbarui data Pekerja Anda
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                            <div class="card-body">
                            @foreach($detailpekerja as $data)
                                <form action="{{ route('cms-admin.data.detail.pekerja.updatepekerja', $data->id_pekerja) }}" method="POST" enctype="multipart/form-data">
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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pekerja :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="namapekerja" type="text" name="Nama" class="form-control" value="{{ $data->nama_pekerja ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email Pekerja :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="emailpekerja" type="email" name="Email" class="form-control" value="{{ $data->email ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Telepon Pekerja :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="teleponpekerja" type="number" name="Telepon" class="form-control" value="{{ $data->no_telp_pekerja ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button id="submit" type="submit" class="btn btn-success">Update Data Pekerja</button>
                                </div>
                            </div>
                            </form>                            
                            @endforeach
                        </div>
                    </div>
                </div>

                <!--- cek kode update password -->
                <div class="col-12">
                    <div class="card">
                            <div class="card-body">
                            <form method="POST" action="{{ route('cms-admin.data.detail.pekerja.perbaruipasswordpekerja', $data->id_pekerja) }}">
                                @method('patch')
                                @csrf
                                <div class="card-header">
                                <h4>Perbarui Kata Sandi Pekerja</h4>
                                </div>
                                <div class="card-body">
                                @if ($errors->has('new_password'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('new_password') }}</li>
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="inputNewPassword">Kata Sandi Baru</label>
                                    <input id="new_password" type="text" class="form-control" name="Password" autocomplete="Password">
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                    Kata Sandi Anda harus 8-20 karakter.
                                    </small>
                                </div>
                                <div class="card-footer bg-whitesmoke text-md-right">
                                    <button class="btn btn-success" type="submit" id="save-btn">Perbarui Kata Sandi</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              </div>  
            </div>
        </div>
    </section>
</div>
@endsection