<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use App\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    $this->middleware('auth:pekerja');
    }

    /**
     * Menampilkan halaman daftar proyek.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dataproyek(Request $request)
    {    
        #data proyek
        $proyek = Proyek::leftjoin('layanan', 'layanan.id_layanan', '=', 'proyek.layanan_id')
        ->leftjoin('klien', 'klien.id_klien', '=', 'proyek.klien_id')
        ->where('proyek.pekerja_id', '=', Auth::user()->id_pekerja)
        ->orderBy('created_at', 'Desc');

        return view('pekerja.data.proyek', compact('proyek'));
    }

    /**
     * Menampilkan halaman data detail proyek.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detaildataproyek($id_proyek)
    {    
        $detailproyek = proyek::where('proyek.id_proyek', '=', $id_proyek)
        ->get();
        
        return view('pekerja.data.detail.proyek', compact('detailproyek'));
    }
}
