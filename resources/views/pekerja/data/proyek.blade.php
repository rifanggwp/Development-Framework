@extends('layouts.pekerja')
@section('content')
<div class="main-content">
<section class="section">
          <div class="section-header">
            <h1>Data Proyek</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item"><a href="#">Data Proyek</a></div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <h5 class="section-title">Proyek di Yola Digital</h5>
                        </div>
                    </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                          <th>
                              No
                            </th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($proyek as $data)    
                          <tr>
                            <td class="number"></td>
                            <td>{{ $data->nama_klien }}</td>
                            <td>{{ $data->email_klien }}</td>
                            <td>0{{ $data->no_telp_klien }}</td>
                            <td>{{ $data->alamat_klien }}</td>
                            <td>
                                <div class="row">
                                  <div class="col-6">
                                    <form action="{{ route('proyek.data.klien.hapusklien',$data->id_klien) }}" method="POST">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat hapus-laporan" data-toggle="tooltip" name="delete">@csrf @method('DELETE')<i class="fa fa-trash"></i></button>
                                    </form>
                                  </div>
                                  <div class="col-6">
                                    <a class="btn btn-xs btn-success btn-flat" href="{{ route('proyek.data.detail.klien',$data->id_klien) }}"><i class="fa fa-pen"></i></a>
                                  </div>
                                </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
</div>
@endsection