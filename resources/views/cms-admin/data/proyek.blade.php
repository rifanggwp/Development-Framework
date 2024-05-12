@extends('layouts.admin')
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
                        <div class="col-lg-4 col-md-4 col-sm-12 tombol">
                            <a class="btn btn-success" href="{{ route('cms-admin.form.tambahproyek') }}"><i class="fa fa-plus"></i>Tambah Proyek</a>
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
                            <th>Layanan</th>
                            <th>Klien</th>
                            <th>Pekerja</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($proyek as $data)    
                          <tr>
                            <td class="number"></td>
                            <td>{{ $data->nama_layanan }}</td>
                            <td>{{ $data->nama_klien }}</td>
                            <td>{{ $data->nama_pekerja }}</td>
                            <td>Rp {{ number_format($data->harga_proyek, 0, ',', '.') }}</td>                          
                            <td>{{ $data->status_proyek }}</td>
                            <td>
                                <div class="row">
                                  <div class="col-6">
                                    <form action="{{ route('cms-admin.data.proyek.hapusproyek',$data->id_proyek) }}" method="POST">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat" data-toggle="tooltip" name="delete">@csrf @method('DELETE')<i class="fa fa-trash"></i></button>
                                    </form>
                                  </div>
                                  <div class="col-6">
                                    <a class="btn btn-xs btn-success btn-flat" href="{{ route('cms-admin.data.detail.proyek',$data->id_proyek) }}"><i class="fa fa-pen"></i></a>
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