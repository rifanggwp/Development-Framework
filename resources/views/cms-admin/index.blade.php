@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title"> Hai  {{ $nama_admin }}, Anda Login Sebagai Admin Yola Digital!</h2>
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
                <div class="card-icon bg-success">
                    <i class="fas fa-check"></i>
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
                <div class="card-icon bg-info">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Barang Disewa</h4>
                    </div>
                    <div class="card-body">
                    {{ $totalbarangdisewakan }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-money-bill"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Total Pemasukkan</h4>
                    </div>
                    <div class="card-body">
                    {{ $totalPemasukkan }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-money-bill"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Total Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                    {{ $totalPengeluaran }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-money-bill"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Total Keuntungan</h4>
                    </div>
                    <div class="card-body">
                    {{ $keuntungan }}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection