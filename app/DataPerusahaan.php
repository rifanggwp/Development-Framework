<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPerusahaan extends Model
{
    protected $table = 'data_perusahaan';

    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //data bersifat bisa diisi
    protected $fillable = [
        'nama_perusahaan', 'deskripsi_perusahaan', 'email_perusahaan', 'no_telp_perusahaan', 'alamat_perusahaan', 'logo_perusahaan', 'logo_perusahaan_path'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'id'
    ];
}
