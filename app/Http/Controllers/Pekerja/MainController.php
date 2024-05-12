<?php

namespace App\Http\Controllers\Pekerja;

use App\Http\Controllers\Controller;
use App\Proyek;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
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
     * Menampilkan halaman home pekerja.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {    
        $pekerjadata = [
            'id_pekerja' => Auth::user()->id_pekerja,     
            'nama_pekerja' => Auth::user()->nama_pekerja,
        ];

        //buat ambil data user pekerja jadi global variable dan clean

        #total proyek berjalan
        $totalproyekberjalan = Proyek::where('proyek.status_proyek', '=', 'Diproses')
        ->where('proyek.pekerja_id', '=', Auth::user()->id_pekerja)
        ->count();

        #total proyek revisi
        $totalproyekrevisi = Proyek::where('proyek.status_proyek', '=', 'Revisi')
        ->where('proyek.pekerja_id', '=', $pekerjadata['id_pekerja'])
        ->count();

        #total proyek prosesverifikasi
        $totalproyekprosesverifikasi = Proyek::where('proyek.status_proyek', '=', 'Proses Verifikasi')
        ->where('proyek.pekerja_id', '=', $pekerjadata['id_pekerja'])
        ->count();

        // Kirim data ke view
        return view('pekerja.index', compact('totalproyekberjalan', 'totalproyekrevisi', 'totalproyekprosesverifikasi'));
    }
}
