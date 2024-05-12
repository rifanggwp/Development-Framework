@extends('layouts.admin')
@section('content')
<div class="main-content">
<section class="section">
          <div class="section-header">
            <h1>Data Pemasukkan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item"><a href="#">Data Pemasukkan</a></div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <h5 class="section-title">Pemasukkan di Yola Digital</h5>
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
                            <th>ID Proyek/Penyewaan</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($pemasukkan as $data)    
                          <tr>
                            <td class="number"></td>
                            <td>
                                @if($data->penyewaan_id == 404)
                                    <a href="{{ route('cms-admin.data.detail.proyek', $data->id_proyek) }}">{{ $data->id_proyek }}</a>
                                @elseif($data->proyek_id == 404)
                                    <a href="{{ route('cms-admin.data.detail.penyewaan', $data->id_penyewaan) }}">{{ $data->id_penyewaan }}</a>
                                @endif
                            </td>
                            <td>
                                @if($data->penyewaan_id == 404)
                                    Rp {{ number_format($data->harga_proyek, 0, ',', '.') }}
                                @elseif($data->proyek_id == 404)
                                    Rp {{ number_format($data->harga_penyewaan, 0, ',', '.') }}
                                @endif
                            </td>
                            <td>{{ $data->keterangan_pemasukkan }}</td>
                            <td>
                                <a href="{{ url('uploads/pemasukkan/' . $data->bukti_pemasukkan) }}" target="_blank">
                                  <img src="{{ url('uploads/pemasukkan/' . $data->bukti_pemasukkan) }}" alt="{{ $data->bukti_pemasukkan }}" style="width:100px;height:100px;">
                                </a>
                            </td>
                            <td>
                                <div class="row">
                                  <div class="col-6">
                                    <form action="{{ route('cms-admin.data.pemasukkan.hapuspemasukkan',$data->id_pemasukkan) }}" method="POST">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat hapus-laporan" data-toggle="tooltip" name="delete">@csrf @method('DELETE')<i class="fa fa-trash"></i></button>
                                    </form>
                                  </div>
                                  <div class="col-6">
                                    <a class="btn btn-xs btn-success btn-flat" href="{{ route('cms-admin.data.detail.pemasukkan',$data->id_pemasukkan) }}"><i class="fa fa-pen"></i></a>
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