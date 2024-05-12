<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Layanan;
use App\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class LayananController extends Controller
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
     * Menampilkan halaman daftar layanan.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function datalayanan(Request $request)
    {    
        #data layanan
        $layanan = Layanan::where('layanan.id_layanan', '<>', 404)
        ->orderBy('nama_layanan', 'Asc')
        ->get();

        return view('cms-admin.data.layanan', compact('layanan'));
    }

    /**
     * Menampilkan halaman data detail layanan.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detaildatalayanan($id_layanan)
    {    
        $detaillayanan = Layanan::where('layanan.id_layanan', '<>', 404)
        ->where('layanan.id_layanan', '=', $id_layanan)
        ->get();
        
        return view('cms-admin.data.detail.layanan', compact('detaillayanan'));
    }

    /**
     * Menampilkan form untuk menambahkan layanan.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tambahlayanan()
    {    
        return view('cms-admin.form.tambahlayanan');
    }

    /**
     * Proses pengiriman data layanan baru.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kirimdatalayanan(Request $request)
    {    
        $request->validate([
            'Nama' => 'required',
            'Keterangan' => 'required',
            'Foto' => 'required|file|mimes:png,jpg,jpeg,webp|max:1024'
        ]);

        $layanan = new Layanan();
        
        $layanan->id_layanan = Str::random(3);
        $layanan->nama_layanan =  $request->input('Nama');
        $layanan->keterangan_layanan = $request->input('Keterangan');
        
        if ($request->hasFile('Foto')) {
            
            $folderPath = public_path('uploads/layanan/');
    
            $fotoPath = $request->file('Foto');
            $fotoName = time() . '.' . $fotoPath->getClientOriginalExtension();
       
            $file = $folderPath . $fotoName;
    
            #code bukti pendukung
            $layanan->foto_layanan = $fotoName;
            $layanan->foto_layanan_path = $file;
        }


        if (1) {
            $request->Foto->move(public_path('uploads/layanan/'), $fotoName);

            $layanan->save();

            Alert::success('Berhasil', 'Layanan Telah Ditambahkan.');
        } else {
            Alert::error('Gagal', 'Periksa kembali data yang Anda masukkan.');
        }

        return redirect()->route('cms-admin.form.tambahlayanan');
    
    }

    /**
     * Proses Update data layanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatelayanan(Request $request, $id_layanan)
    {
        $request->validate([
            'Nama' => 'required',
            'Keterangan' => 'required',
        ]);

        Layanan::where('id_layanan', $id_layanan)->update([
            'nama_layanan' => $request->input('Nama'),
            'keterangan_layanan' => $request->input('Keterangan'),
        ]);

        if (1) {
            Alert::success('Data Diperbarui', 'Data Layanan berhasil diperbarui.');

            return redirect()->route('cms-admin.data.detail.layanan', $id_layanan);
        } else {
            Alert::error('Gagal, Periksa Kembali data yang Anda kirim');

            return back();
        }
    }

    /**
     * Menghapus foto layanan
     *
     * @return \Illuminate\Http\Response
     */
    public function hapusfotolayanan($id_layanan)
    {        
        $datafotolayanan = Layanan::where('id_layanan', $id_layanan)->first();
        unlink('uploads/layanan/'.$datafotolayanan->foto_layanan);
        
        Layanan::where('id_layanan', $id_layanan)->update([
            #code update
            'foto_layanan' => 'Tidak Ada',
            'foto_layanan_path' => 'Tidak Ada'
        ]);

        if (1) {
            Alert::success('Foto Layanan Dihapus', 'foto Layanan telah dihapus.');
            return redirect()->route('cms-admin.data.detail.layanan', $id_layanan);
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }

    /**
     * Proses Update foto Layanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upfotolayanan(Request $request, $id_layanan)
    {
        $request->validate([
            'Foto' => 'required|file|mimes:png,jpg,jpeg,webp|max:1024'
        ]);

        if ($request->hasFile('Foto')) {
            
            $folderPath = public_path('uploads/layanan/');
    
            $fotoPath = $request->file('Foto');
            $fotoName = time() . '.' . $fotoPath->getClientOriginalExtension();
       
            $file = $folderPath . $fotoName;
        }

        Layanan::where('layanan.id_layanan', '=', $id_layanan)->update([
            #code foto
            'foto_layanan' => $fotoName,
            'foto_layanan_path' => $file
        ]);

        if (1) {
            $request->Foto->move(public_path('uploads/layanan/'), $fotoName);

            Alert::success('Berhasil', 'foto Layanan berhasil diperbarui.');

            return redirect()->route('cms-admin.data.detail.layanan', $id_layanan);
        } else {
            Alert::error('Gagal', 'Periksa kembali foto yang diupload.');

            return back();
        }
    }

    /**
     * Menghapus layanan
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapuslayanan($id_layanan)
    {
        // update semua data proyek yang memiliki id layanan akan dihapus
        Proyek::where('layanan_id', $id_layanan)->update(['layanan_id' => '404']);

        $cekfoto = Layanan::where('foto_layanan', '=', 'Tidak Ada')->get();

        if ($cekfoto) {
            $delete = Layanan::where('id_layanan',$id_layanan);
            $delete->delete();
        } else {
            $delete = Layanan::where('id_layanan',$id_layanan)->first();
            unlink('uploads/layanan/'.$delete->foto_layanan);
            $delete->delete();
        }

        if ($delete = 1) {
            Alert::success('Berhasil Dihapus', 'Layanan anda telah dihapus.');
            return redirect()->route('cms-admin.data.layanan');
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }
}
