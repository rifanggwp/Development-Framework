<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pemasukkan;
use Illuminate\Http\Request;

class PemasukkanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    $this->middleware('auth:admin');
    }

    /**
     * Menampilkan halaman daftar pemasukkan.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function datapemasukkan(Request $request)
    {    
        #data pemasukkan
        $pemasukkan = Pemasukkan::leftjoin('proyek', 'proyek.id_proyek', '=', 'pemasukkan.proyek_id')
        ->leftjoin('penyewaan', 'penyewaan.id_penyewaan', '=', 'pemasukkan.penyewaan_id')
        ->orderBy('pemasukkan.created_at', 'Desc')
        ->get();

        return view('cms-admin.data.pemasukkan', compact('pemasukkan'));
    }

    /**
     * Menampilkan halaman data detail pemasukkan.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detaildatapemasukkan($id_pemasukkan)
    {    
        $detailpemasukkan = Pemasukkan::leftjoin('proyek', 'proyek.id_proyek', '=', 'pemasukkan.proyek_id')
        ->leftjoin('penyewaan', 'penyewaan.id_penyewaan', '=', 'pemasukkan.penyewaan_id')('layanan', 'layanan.id_layanan', '=', 'pemasukkan.layanan_id')
        ->leftjoin('klien', 'klien.id_klien', '=', 'pemasukkan.klien_id')
        ->leftjoin('pekerja', 'pekerja.id_pekerja', '=', 'pemasukkan.pekerja_id')
        ->where('pemasukkan.id_pemasukkan', '=', $id_pemasukkan)
        ->get();
        
        return view('cms-admin.data.detail.pemasukkan', compact('detailpemasukkan'));
    }
}
