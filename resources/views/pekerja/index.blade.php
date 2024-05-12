@extends('layouts.pekerja')
@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title"> Hai  {{ $nama_pekerja }}, Anda Login Sebagai Pekerja Yola Digital!</h2>
        </div>
        <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Proyek Berjalan</h4>
                    </div>
                    <div class="card-body">
                    {{ $totalproyekberjalan }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-pen"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Proyek Revisi</h4>
                    </div>
                    <div class="card-body">
                    {{ $totalproyekrevisi }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Proses Verifikasi</h4>
                    </div>
                    <div class="card-body">
                    {{ $totalproyekprosesverifikasi }}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection