@extends('layouts.admin')
@section('content')
<div class="main-content">
<section class="section">
          <div class="section-header">
            <h1>Data Layanan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item"><a href="#">Data Layanan</a></div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <h5 class="section-title">Layanan di Yola Digital</h5>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 tombol">
                            <a class="btn btn-success" href="{{ route('cms-admin.form.tambahlayanan') }}"><i class="fa fa-plus"></i>Tambah Layanan</a>
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
                            <th>Keterangan</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($layanan as $data)    
                          <tr>
                            <td class="number"></td>
                            <td>{{ $data->nama_layanan }}</td>
                            <td>{{ $data->keterangan_layanan }}</td>
                            <td>
                              @if($data->foto_layanan === 'Tidak Ada')
                                  <p>Tidak Ada Foto Layanan</p>
                              @else
                                  <a href="{{ url('uploads/layanan/' . $data->foto_layanan) }}" target="_blank">
                                      <img src="{{ url('uploads/layanan/' . $data->foto_layanan) }}" alt="{{ $data->foto_layanan }}" style="width:100px;">
                                  </a>
                              @endif
                            </td>
                            <td>
                                <div class="row">
                                  <div class="col-6">
                                    <form action="{{ route('cms-admin.data.hapuslayanan',$data->id_layanan) }}" method="POST">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat" data-toggle="tooltip" name="delete">@csrf @method('DELETE')<i class="fa fa-trash"></i></button>
                                    </form>
                                  </div>
                                  <div class="col-6">
                                    <a class="btn btn-xs btn-success btn-flat" href="{{ route('cms-admin.data.detail.layanan',$data->id_layanan) }}"><i class="fa fa-pen"></i></a>
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