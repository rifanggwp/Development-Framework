<?php

namespace App\Http\Controllers\Admin;

use App\Gaji;
use App\Http\Controllers\Controller;
use App\Pemasukkan;
use App\Pengeluaran;
use App\Penyewaan;
use App\Proyek;

class MainController extends Controller
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
     * Menampilkan halaman home admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {    
        #total proyek berjalan
        $totalproyekberjalan = Proyek::where('proyek.status_proyek', '=', 'Diproses')
        ->count();

        #total proyek revisi
        $totalproyekrevisi = Proyek::where('proyek.status_proyek', '=', 'Revisi')
        ->count();

        #total barang disewakan
        $totalbarangdisewakan = Penyewaan::where('penyewaan.status_penyewaan', '=', 'Disewa')
        ->count();

        // Hitung total pemasukkan
        $totalPemasukkan = Pemasukkan::join('proyek', 'pemasukkan.proyek_id', '=', 'proyek.id_proyek')
        ->join('penyewaan', 'pemasukkan.penyewaan_id', '=', 'penyewaan.id_penyewaan')
        ->selectRaw('SUM(proyek.harga_proyek + penyewaan.harga_penyewaan) as total_pemasukkan')
        ->first()
        ->total_pemasukkan;

        // Hitung total pengeluaran
        $totalPengeluaran = Pengeluaran::sum('jumlah_pengeluaran') + Gaji::sum('jumlah_gaji');

        // Hitung keuntungan
        $keuntungan = $totalPemasukkan - $totalPengeluaran;

        // Format ke dalam rupiah
        $totalPemasukkan = $this->formatToRupiah($totalPemasukkan);
        $totalPengeluaran = $this->formatToRupiah($totalPengeluaran);
        $keuntungan = $this->formatToRupiah($keuntungan);

        // Kirim data ke view
        return view('cms-admin.index', compact('totalproyekberjalan', 'totalproyekrevisi', 'totalbarangdisewakan', 'totalPemasukkan', 'totalPengeluaran', 'keuntungan'));
    }

    private function formatToRupiah($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}
