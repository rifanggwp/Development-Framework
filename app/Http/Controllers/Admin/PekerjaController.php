<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Gaji;
use App\Http\Controllers\Controller;
use App\Pekerja;
use App\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PekerjaController extends Controller
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
     * Menampilkan halaman daftar pekerja.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function datapekerja(Request $request)
    {    
        #data pekerja
        $pekerja = Pekerja::where('pekerja.id_pekerja', '<>', 404)
        ->orderBy('nama_pekerja', 'Asc')
        ->get();

        return view('cms-admin.data.pekerja', compact('pekerja'));
    }

    /**
     * Menampilkan halaman data detail pekerja.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detaildatapekerja($id_pekerja)
    {    
        $detailpekerja = Pekerja::where('pekerja.id_pekerja', '<>', 404)
        ->where('pekerja.id_pekerja', '=', $id_pekerja)
        ->get();
        
        return view('cms-admin.data.detail.pekerja', compact('detailpekerja'));
    }

    /**
     * Menampilkan form untuk menambahkan pekerja.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tambahpekerja()
    {    
        return view('cms-admin.form.tambahpekerja');
    }

    /**
     * Proses pengiriman data pekerja baru.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kirimdatapekerja(Request $request)
    {    
        $request->validate([            
            'Nama' => 'required',
            'Email' => 'required',
            'Telepon' => 'required',
            'Password' => 'required|string|min:8'
        ]);

        $email = $request->input('Email');

        $EmailModels = [Pekerja::class,  Admin::class];

        foreach ($EmailModels as $dataemail) {
            $PeriksaEmail = $dataemail::where('email', $email)->first();

            if ($PeriksaEmail !== null) {
                // Email sudah digunakan di salah satu tabel
                Alert::error('Gagal Mengirim', 'Email sudah digunakan.');
                return back();
            }
        }

        
        //bikin kode untuk cek nomor telepon, atur juga di databasenya karena nama kolom di model admin dan pekerja berbeda


        // Jika loop selesai dan belum return, artinya NIP belum digunakan di semua tabel
        $pekerja = new Pekerja();  
        $pekerja->id_pekerja = Str::random(4);              
        $pekerja->nama_pekerja = $request->input('Nama');
        $pekerja->email = $email;
        $pekerja->no_telp_pekerja = $request->input('Telepon');
        $pekerja->Password = Hash::make($request->Password);

        if ($pekerja->save()) {
            Alert::success('Pekerja Ditambahkan', 'Anda berhasil menambahkan Pekerja baru.');
        
            return redirect()->route('cms-admin.form.tambahpekerja');
        } else {
            Alert::error('Gagal Mengirim', 'Gagal menyimpan data Pekerja.');
            return back();
        }
    
    }

    /**
     * Proses Update data pekerja.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatepekerja(Request $request, $id_pekerja)
    {
        $request->validate([
            'Nama' => 'required',
            'Email' => 'required|email',
            'Telepon' => 'required|numeric',
        ]);

        Pekerja::where('id_pekerja', $id_pekerja)->update([
            'nama_pekerja' => $request->get('Nama'),            
            'email' => $request->get('Email'), 
            'no_telp_pekerja' => $request->get('Telepon'),
        ]);

        if (1) {
            Alert::success('Data Diperbarui', 'Data Pekerja berhasil diperbarui.');

            return back();
        } else {
            Alert::toast('Gagal, Periksa Kembali data yang Anda kirim','error');

            return back();
        }
    }

    /**
         * Proses memperbarui password pekerja.
         *
         * @return \Illuminate\Contracts\Support\Renderable
         */
        public function perbaruipasswordpekerja(Request $request, $id_pekerja)
        {    
            $request->validate([
                'Password' => ['required', 'string', 'min:8']
            ]);
        
            $pekerjaData = $request->only(["Paspasswordsword"]);
            $pekerjaData['Password'] = Hash::make($pekerjaData['Password']);
            Pekerja::where('id_pekerja', $id_pekerja)->update($pekerjaData);
        
            if (1) {
                Alert::success('Password Diperbarui', 'Password Pekerja berhasil diperbarui.');
                
                return back();
            } else {
                Alert::error('Gagal Mengirim', 'Periksa kembali data yang dikirim');
        
                return back();
            }
        }

    /**
     * Menghapus pekerja
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapuspekerja($id_pekerja)
    {
        $delete = Pekerja::where('id_pekerja', '=', $id_pekerja);

        // update semua data proyek yang memiliki id pekerja akan dihapus
        Proyek::where('Pekerja_id', $id_pekerja)->update(['Pekerja_id' => '404']);
        // update semua data gaji yang memiliki id pekerja akan dihapus
        Gaji::where('Pekerja_id', $id_pekerja)->update(['Pekerja_id' => '404']);

        $delete->delete();
        
        if ($delete = 1) {
            Alert::success('Pekerja Dihapus', 'Pekerja telah dihapus.');
            return back();
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }
}
