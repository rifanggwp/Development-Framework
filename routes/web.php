<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // Cek apakah pengguna sudah terotentikasi
    if (Auth::guard('admin')->check()) {
        return redirect('cms-admin/index');
    } elseif (Auth::guard('pekerja')->check()) {
        return redirect('pekerja/index');
    } 

    // Jika tidak ada yang terotentikasi, tampilkan halaman login
    return view('auth.login');
});


// Middleware to check if any of the guards are authenticated
Route::middleware(function ($request, $next) {
    if (Auth::guard('admin')->check() || Auth::guard('pekerja')->check()) {
        // Redirect to the respective home based on the guard
        if (Auth::guard('admin')->check()) {
            return redirect('cms-admin/index');
        } elseif (Auth::guard('pekerja')->check()) {
            return redirect('pekerja/index');
        }
    }

    // If none of the guards are authenticated, proceed with the request
    return $next($request);
})->group(function () {
    Auth::routes();
});

// Logout route for admin
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//pekerja wajib melakukan login
Route::middleware('auth:pekerja')->group(function(){
    //halaman dashboard pekerja
    Route::get('/pekerja/index', 'Pekerja\MainController@index')->name('pekerja.index');
    //profil pekerja
    Route::get('/pekerja/profil', 'Pekerja\MainController@profil')->name('pekerja.profil.index');
    //perbarui profil pekerja
    Route::patch('/pekerja/profil/updateprofil', 'Pekerja\MainController@updateprofil')->name('pekerja.profil.updateprofil');
    //update password
    Route::get('/pekerja/profil/password', 'Pekerja\MainController@perbaruipassword')->name('pekerja.profil.password');
    Route::patch('/pekerja/profil/change-password', 'Pekerja\MainController@updatepassword')->name('pekerja.change.password');

    //daftar gaji
    Route::get('/pekerja/data/gaji', 'Pekerja\ProyekController@datagaji')->name('pekerja.data.gaji');
    //lihat detail gaji
    Route::get('/pekerja/data/detail/gaji/{id_gaji}', 'Pekerja\ProyekController@detaildatagaji')->name('pekerja.data.detail.gaji');

    //daftar proyek
    Route::get('/pekerja/data/proyek', 'Pekerja\ProyekController@dataproyek')->name('pekerja.data.proyek');
    //lihat detail proyek
    Route::get('/pekerja/data/detail/proyek/{id_proyek}', 'Pekerja\ProyekController@detaildataproyek')->name('pekerja.data.detail.proyek');

    //form tambah proyek update
    Route::get('/pekerja/form/tambahupdateproyek', 'Pekerja\ProyekController@tambahupdateproyek')->name('pekerja.form.tambahupdateproyek');
    Route::post('/pekerja/form/kirimdataupdateproyek/', 'Pekerja\ProyekController@kirimdataupdateproyek')->name('pekerja.form.kirimdataupdateproyek');
    //daftar proyek update
    Route::get('/pekerja/data/proyekupdate', 'Pekerja\ProyekController@dataproyekupdate')->name('pekerja.data.proyekupdate');
    //lihat detail proyek update
    Route::get('/pekerja/data/detail/proyekupdate/{id_update}', 'Pekerja\ProyekController@detaildataproyekupdate')->name('pekerja.data.detail.proyekupdate');
    //update proyek update
    Route::patch('/pekerja/data/detail/proyekupdate/{id_update}', 'Pekerja\ProyekController@updateproyekupdate')->name('pekerja.data.detail.proyekupdate.updateproyekupdate');
    //proses menghapus proyek update
    Route::delete('/pekerja/data/proyekupdate/{id_update}', 'Pekerja\ProyekController@hapusproyekupdate')->name('pekerja.data.proyek.hapusproyekupdate');
    //proses menghapus proyek update di halaman detail
    Route::delete('/pekerja/data/detail/proyekupdate/{id_update}', 'Pekerja\ProyekController@hapusproyekupdatedidetail')->name('pekerja.data.detail.proyek.hapusproyekupdatedidetail');
});

//admin wajib melakukan login
Route::middleware('auth:admin')->group(function(){
    //halaman dashboard admin
    Route::get('/cms-admin/index', 'Admin\MainController@index')->name('cms-admin.index');
    //profil admin
    Route::get('/cms-admin/profil', 'Admin\MainController@profil')->name('cms-admin.profil.index');
    //perbarui profil admin
    Route::patch('/cms-admin/profil/updateprofil', 'Admin\MainController@updateprofil')->name('cms-admin.profil.updateprofil');
    //update password
    Route::get('/cms-admin/profil/password', 'Admin\MainController@perbaruipassword')->name('cms-admin.profil.password');
    Route::patch('/cms-admin/profil/change-password', 'Admin\MainController@updatepassword')->name('cms-admin.change.password');
    
    //form tambah layanan
    Route::get('/cms-admin/form/tambahlayanan', 'Admin\LayananController@tambahlayanan')->name('cms-admin.form.tambahlayanan');
    Route::post('/cms-admin/form/kirimdatalayanan/', 'Admin\LayananController@kirimdatalayanan')->name('cms-admin.form.kirimdatalayanan');
    //daftar layanan
    Route::get('/cms-admin/data/layanan', 'Admin\LayananController@datalayanan')->name('cms-admin.data.layanan');
    //lihat detail layanan
    Route::get('/cms-admin/data/detail/layanan/{id_layanan}', 'Admin\LayananController@detaildatalayanan')->name('cms-admin.data.detail.layanan');
    //update layanan
    Route::patch('/cms-admin/data/detail/layanan/{id_layanan}', 'Admin\LayananController@updatelayanan')->name('cms-admin.data.detail.layanan.updatelayanan');
    //hapus logo layanan
    Route::patch('/cms-admin/data/detail/layanan/{id_layanan}/hapus-foto', 'Admin\LayananController@hapusfotolayanan')->name('cms-admin.data.detail.layanan.hapus-foto');
    //upload logo layanan
    Route::patch('/cms-admin/data/detail/layanan/{id_layanan}/upload-foto', 'Admin\LayananController@upfotolayanan')->name('cms-admin.data.detail.layanan.upload-foto');
    //proses menghapus layanan
    Route::delete('/cms-admin/data/layanan/{id_layanan}', 'Admin\LayananController@hapuslayanan')->name('cms-admin.data.hapuslayanan');

    //form tambah klien
    Route::get('/cms-admin/form/tambahklien', 'Admin\KlienController@tambahklien')->name('cms-admin.form.tambahklien');
    Route::post('/cms-admin/form/kirimdataklien/', 'Admin\KlienController@kirimdataklien')->name('cms-admin.form.kirimdataklien');
    //daftar klien
    Route::get('/cms-admin/data/klien', 'Admin\KlienController@dataklien')->name('cms-admin.data.klien');
    //lihat detail klien
    Route::get('/cms-admin/data/detail/klien/{id_klien}', 'Admin\KlienController@detaildataklien')->name('cms-admin.data.detail.klien');
    //update klien
    Route::patch('/cms-admin/data/detail/klien/{id_klien}', 'Admin\KlienController@updateklien')->name('cms-admin.data.detail.klien.updateklien');
    //proses menghapus klien
    Route::delete('/cms-admin/data/klien/{id_klien}', 'Admin\KlienController@hapusklien')->name('cms-admin.data.klien.hapusklien');
    
    //form tambah pekerja
    Route::get('/cms-admin/form/tambahpekerja', 'Admin\PekerjaController@tambahpekerja')->name('cms-admin.form.tambahpekerja');
    Route::post('/cms-admin/form/kirimdatapekerja/', 'Admin\PekerjaController@kirimdatapekerja')->name('cms-admin.form.kirimdatapekerja');
    //daftar pekerja
    Route::get('/cms-admin/data/pekerja', 'Admin\PekerjaController@datapekerja')->name('cms-admin.data.pekerja');
    //lihat detail pekerja
    Route::get('/cms-admin/data/detail/pekerja/{id_pekerja}', 'Admin\PekerjaController@detaildatapekerja')->name('cms-admin.data.detail.pekerja');
    //update pekerja
    Route::patch('/cms-admin/data/detail/pekerja/{id_pekerja}/updatepekerja', 'Admin\PekerjaController@updatepekerja')->name('cms-admin.data.detail.pekerja.updatepekerja');
    //proses update password pekerja
    Route::patch('/cms-admin/data/detail/pekerja/{id_pekerja}/perbaruipasswordpekerja', 'Admin\PekerjaController@perbaruipasswordpekerja')->name('cms-admin.data.detail.pekerja.perbaruipasswordpekerja');
    //proses menghapus pekerja
    Route::delete('/cms-admin/data/pekerja/{id_pekerja}', 'Admin\PekerjaController@hapuspekerja')->name('cms-admin.data.pekerja.hapuspekerja');
    
    //form tambah proyek
    Route::get('/cms-admin/form/tambahproyek', 'Admin\ProyekController@tambahproyek')->name('cms-admin.form.tambahproyek');
    Route::post('/cms-admin/form/kirimdataproyek/', 'Admin\ProyekController@kirimdataproyek')->name('cms-admin.form.kirimdataproyek');
    //daftar proyek
    Route::get('/cms-admin/data/proyek', 'Admin\ProyekController@dataproyek')->name('cms-admin.data.proyek');
    //lihat detail proyek
    Route::get('/cms-admin/data/detail/proyek/{id_proyek}', 'Admin\ProyekController@detaildataproyek')->name('cms-admin.data.detail.proyek');
    //update proyek
    Route::patch('/cms-admin/data/detail/proyek/{id_proyek}', 'Admin\ProyekController@updateproyek')->name('cms-admin.data.detail.proyek.updateproyek');
    //proses menghapus proyek
    Route::delete('/cms-admin/data/proyek/{id_proyek}', 'Admin\ProyekController@hapusproyek')->name('cms-admin.data.proyek.hapusproyek');

    //daftar proyek update
    Route::get('/cms-admin/data/proyekupdate', 'Admin\ProyekUpdateController@dataproyekupdate')->name('cms-admin.data.proyekupdate');
    //lihat detail proyek update
    Route::get('/cms-admin/data/detail/proyekupdate/{id_update}', 'Admin\ProyekUpdateController@detaildataproyekupdate')->name('cms-admin.data.detail.proyekupdate');
    //proses menghapus proyek update
    Route::delete('/cms-admin/data/proyekupdate/{id_update}', 'Admin\ProyekUpdateController@hapusproyekupdate')->name('cms-admin.data.proyek.hapusproyekupdate');

    //form tambah penyewaan
    Route::get('/cms-admin/form/tambahpenyewaan', 'Admin\PenyewaanController@tambahpenyewaan')->name('cms-admin.form.tambahpenyewaan');
    Route::post('/cms-admin/form/kirimdatapenyewaan/', 'Admin\PenyewaanController@kirimdatapenyewaan')->name('cms-admin.form.kirimdatapenyewaan');
    //daftar penyewaan
    Route::get('/cms-admin/data/penyewaan', 'Admin\PenyewaanController@datapenyewaan')->name('cms-admin.data.penyewaan');
    //lihat detail penyewaan
    Route::get('/cms-admin/data/detail/penyewaan/{id_penyewaan}', 'Admin\PenyewaanController@detaildatapenyewaan')->name('cms-admin.data.detail.penyewaan');
    //update penyewaan
    Route::patch('/cms-admin/data/detail/penyewaan/{id_penyewaan}', 'Admin\PenyewaanController@updatepenyewaan')->name('cms-admin.data.detail.penyewaan.updatepenyewaan');
    //proses menghapus penyewaan
    Route::delete('/cms-admin/data/penyewaan/{id_penyewaan}', 'Admin\PenyewaanController@hapuspenyewaan')->name('cms-admin.data.penyewaan.hapuspenyewaan');

    //daftar pemasukkan
    Route::get('/cms-admin/data/pemasukkan', 'Admin\PemasukkanController@datapemasukkan')->name('cms-admin.data.pemasukkan');
    //lihat detail pemasukkan
    Route::get('/cms-admin/data/detail/pemasukkan/{id_pemasukkan}', 'Admin\PemasukkanController@detaildatapemasukkan')->name('cms-admin.data.detail.pemasukkan');
    //update pemasukkan
    Route::patch('/cms-admin/data/detail/pemasukkan/{id_pemasukkan}', 'Admin\PemasukkanController@updatepemasukkan')->name('cms-admin.data.detail.pemasukkan.updatepemasukkan');
    //proses menghapus pemasukkan
    Route::delete('/cms-admin/data/pemasukkan/{id_pemasukkan}', 'Admin\PemasukkanController@hapuspemasukkan')->name('cms-admin.data.pemasukkan.hapuspemasukkan');

    //form tambah pengeluaran
    Route::get('/cms-admin/form/tambahpengeluaran', 'Admin\PengeluaranController@tambahpengeluaran')->name('cms-admin.form.tambahpengeluaran');
    Route::post('/cms-admin/form/kirimdatapengeluaran/', 'Admin\PengeluaranController@kirimdatapengeluaran')->name('cms-admin.form.kirimdatapengeluaran');
    //daftar pengeluaran
    Route::get('/cms-admin/data/pengeluaran', 'Admin\PengeluaranController@datapengeluaran')->name('cms-admin.data.pengeluaran');
    //lihat detail pengeluaran
    Route::get('/cms-admin/data/detail/pengeluaran/{id_pengeluaran}', 'Admin\PengeluaranController@detaildatapengeluaran')->name('cms-admin.data.detail.pengeluaran');
    //update pengeluaran
    Route::patch('/cms-admin/data/detail/pengeluaran/{id_pengeluaran}', 'Admin\PengeluaranController@updatepengeluaran')->name('cms-admin.data.detail.pengeluaran.updatepengeluaran');
    //proses menghapus pengeluaran
    Route::delete('/cms-admin/data/pengeluaran/{id_pengeluaran}', 'Admin\PengeluaranController@hapuspengeluaran')->name('cms-admin.data.pengeluaran.hapuspengeluaran');

    //form tambah gaji
    Route::get('/cms-admin/form/tambahgaji', 'Admin\GajiController@tambahgaji')->name('cms-admin.form.tambahgaji');
    Route::post('/cms-admin/form/kirimdatagaji/', 'Admin\GajiController@kirimdatagaji')->name('cms-admin.form.kirimdatagaji');
    //daftar gaji
    Route::get('/cms-admin/data/gaji', 'Admin\GajiController@datagaji')->name('cms-admin.data.gaji');
    //lihat detail gaji
    Route::get('/cms-admin/data/detail/gaji/{id_gaji}', 'Admin\GajiController@detaildatagaji')->name('cms-admin.data.detail.gaji');
    //update gaji
    Route::patch('/cms-admin/data/detail/gaji/{id_gaji}', 'Admin\GajiController@updategaji')->name('cms-admin.data.detail.gaji.updategaji');
    //proses menghapus gaji
    Route::delete('/cms-admin/data/gaji/{id_gaji}', 'Admin\GajiController@hapusgaji')->name('cms-admin.data.gaji.hapusgaji');
});
