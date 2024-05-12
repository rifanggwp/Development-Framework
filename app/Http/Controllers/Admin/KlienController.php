<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Klien;
use App\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class KlienController extends Controller
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
     * Menampilkan halaman daftar klien.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dataklien(Request $request)
    {    
        #data klien
        $klien = Klien::where('klien.id_klien', '<>', 404)
        ->orderBy('nama_klien', 'Asc')
        ->get();

        return view('cms-admin.data.klien', compact('klien'));
    }

    /**
     * Menampilkan halaman data detail klien.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detaildataklien($id_klien)
    {    
        $detailklien = Klien::where('klien.id_klien', '<>', 404)
        ->where('klien.id_klien', '=', $id_klien)
        ->get();
        
        return view('cms-admin.data.detail.klien', compact('detailklien'));
    }

    /**
     * Menampilkan form untuk menambahkan klien.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tambahklien()
    {    
        return view('cms-admin.form.tambahklien');
    }

    /**
     * Proses pengiriman data klien baru.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kirimdataklien(Request $request)
    {    
        $request->validate([
            'Nama' => 'required',
            'Email' => 'required|email',
            'Telepon' => 'required|numeric',
            'Alamat' => 'required',
        ]);

        $klien = new Klien();
        
        $klien->id_klien = Str::random(6);
        $klien->nama_klien =  $request->input('Nama');
        $klien->email_klien = $request->input('Email');
        $klien->no_telp_klien = $request->input('Telepon');
        $klien->alamat_klien = $request->input('Alamat');
        
        if (1) {

            $klien->save();

            Alert::success('Berhasil', 'Klien Telah Ditambahkan.');
        } else {
            Alert::error('Gagal', 'Periksa kembali data yang Anda masukkan.');
        }

        return redirect()->route('cms-admin.form.tambahklien');
    
    }

    /**
     * Proses Update data klien.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateklien(Request $request, $id_klien)
    {
        $request->validate([
            'Nama' => 'required',
            'Email' => 'required|email',
            'Telepon' => 'required|numeric',
            'Alamat' => 'required',
        ]);

        Klien::where('id_klien', $id_klien)->update([
            'nama_klien' => $request->input('Nama'),
            'email_klien' => $request->input('Email'),
            'no_telp_klien' => $request->input('Telepon'),
            'alamat_klien' => $request->input('Alamat'),
        ]);

        if (1) {
            Alert::success('Data Diperbarui', 'Data klien berhasil diperbarui.');

            return redirect()->route('cms-admin.data.detail.klien', $id_klien);
        } else {
            Alert::error('Gagal, Periksa Kembali data yang Anda kirim');

            return back();
        }
    }

    /**
     * Menghapus klien
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapusklien($id_klien)
    {
        $delete = Klien::where('id_klien', '=', $id_klien);

        // update semua data proyek yang memiliki id klien akan dihapus
        Proyek::where('klien_id', $id_klien)->update(['klien_id' => '404']);

        $delete->delete();
        
        if ($delete = 1) {
            Alert::success('Klien Dihapus', 'Klien telah dihapus.');
            return back();
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }
}
