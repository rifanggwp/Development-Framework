<?php

namespace App\Http\Controllers\Admin;

use App\Gaji;
use App\Http\Controllers\Controller;
use App\Klien;
use App\Layanan;
use App\Pekerja;
use App\Pemasukkan;
use App\Pengeluaran;
use App\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProyekController extends Controller
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
     * Menampilkan halaman daftar proyek.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dataproyek(Request $request)
    {    
        #data proyek
        $proyek = Proyek::leftjoin('layanan', 'layanan.id_layanan', '=', 'proyek.layanan_id')
        ->leftjoin('klien', 'klien.id_klien', '=', 'proyek.klien_id')
        ->leftjoin('pekerja', 'pekerja.id_pekerja', '=', 'proyek.pekerja_id')
        ->where('proyek.id_proyek', '<>', 404)
        ->orderBy('proyek.created_at', 'Desc')
        ->get();

        return view('cms-admin.data.proyek', compact('proyek'));
    }

    /**
     * Menampilkan halaman data detail proyek.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detaildataproyek($id_proyek)
    {    
        $detailproyek = Proyek::leftjoin('layanan', 'layanan.id_layanan', '=', 'proyek.layanan_id')
        ->leftjoin('klien', 'klien.id_klien', '=', 'proyek.klien_id')
        ->leftjoin('pekerja', 'pekerja.id_pekerja', '=', 'proyek.pekerja_id')
        ->where('proyek.id_proyek', '<>', 404)
        ->where('proyek.id_proyek', '=', $id_proyek)
        ->get();
        
        return view('cms-admin.data.detail.proyek', compact('detailproyek'));
    }

    /**
     * Menampilkan form untuk menambahkan proyek.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tambahproyek()
    {            
        $layanan = Layanan::where('layanan.id_layanan', '<>', 404)->pluck("nama_layanan","id_layanan");
        $klien = Klien::where('klien.id_klien', '<>', 404)->pluck("email_klien","id_klien");
        $pekerja = Pekerja::where('pekerja.id_pekerja', '<>', 404)->pluck("nama_pekerja","id_pekerja");

        return view('cms-admin.form.tambahproyek', compact('klien', 'layanan', 'pekerja'));
    }

    /**
     * Proses pengiriman data proyek baru.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kirimdataproyek(Request $request)
    {    
        $request->validate([
            'Layanan' => 'required',
            'Klien' => 'required',
            'Pekerja' => 'required',
            'Harga' => 'required|numeric',
            'Keterangan-Proyek' => 'nullable',
            'Keterangan-Pembayaran' => 'required',
            'Bukti' => 'required|file|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        //proses untuk tabel proyek

        $proyek = new proyek();
        
        $proyek->id_proyek = Str::random(8);
        $proyek->layanan_id =  $request->input('Layanan');
        $proyek->klien_id = $request->input('Klien');
        $proyek->pekerja_id = $request->input('Pekerja');
        $proyek->harga_proyek = $request->input('Harga');
        $proyek->ket_tambahan = $request->input('Keterangan-Proyek');        
        $proyek->status_proyek = 'Diproses';

        // Proses untuk tabel pemasukkan
        $pemasukkan = new Pemasukkan();
        $pemasukkan->proyek_id = $proyek->id_proyek; // Mengambil id_proyek dari proyek yang baru dibuat
        $pemasukkan->penyewaan_id = '404'; // Nilai default
        $pemasukkan->keterangan_pemasukkan = $request->input('Keterangan-Pembayaran');

        if ($request->hasFile('Bukti')) {
            
            $folderPath = public_path('uploads/pemasukkan/');
    
            $buktiPath = $request->file('Bukti');
            $buktiName = time() . '.' . $buktiPath->getClientOriginalExtension();
       
            $file = $folderPath . $buktiName;
    
            #code bukti pendukung
            $pemasukkan->bukti_pemasukkan = $buktiName;
            $pemasukkan->bukti_pemasukkan_path = $file;
        }
        
        if (1) {
            $request->Bukti->move(public_path('uploads/pemasukkan/'), $buktiName);

            $proyek->save() && $pemasukkan->save();

            Alert::success('Berhasil', 'Proyek Telah Ditambahkan.');
        } else {
            Alert::error('Gagal', 'Periksa kembali data yang Anda masukkan.');
        }

        return redirect()->route('cms-admin.form.tambahproyek');
    
    }

    /**
     * Proses Update data proyek.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateproyek(Request $request, $id_proyek)
    {
        $request->validate([
            'Pekerja' => 'required',
            'Harga' => 'required|numeric',
            'Status' => 'required'
        ]);

        Proyek::where('id_proyek', $id_proyek)->update([
            'pekerja_id' => $request->input('Pekerja'),
            'harga_proyek' => $request->input('Harga'),
            'ket_tambahan' => $request->input('Keterangan'),
            'status_proyek' => $request->input('Status'),
        ]);

        if (1) {
            Alert::success('Data Diperbarui', 'Data proyek berhasil diperbarui.');

            return redirect()->route('cms-admin.data.detail.proyek', $id_proyek);
        } else {
            Alert::error('Gagal, Periksa Kembali data yang Anda kirim');

            return back();
        }
    }

    /**
     * Menghapus proyek
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapusproyek($id_proyek)
    {
        $delete = Proyek::where('id_proyek', '=', $id_proyek);

        // update semua data gaji yang memiliki id proyek akan dihapus
        Gaji::where('proyek_id', $id_proyek)->update(['proyek_id' => '404']);
        // update semua data gaji yang memiliki id proyek akan dihapus
        Pemasukkan::where('proyek_id', $id_proyek)->update(['proyek_id' => '404']);        
        Pengeluaran::where('proyek_id', $id_proyek)->update(['proyek_id' => '404']);

        $delete->delete();
        
        if ($delete = 1) {
            Alert::success('Proyek Dihapus', 'Proyek telah dihapus.');
            return back();
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }
}
