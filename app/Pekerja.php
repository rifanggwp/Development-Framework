<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;

class Pekerja extends Authenticable
{
    //melindungi table
    protected $table = 'pekerja';

    //melindungi pekerja
    protected $guard = 'pekerja';

    protected $primaryKey = 'id_pekerja';
    protected $appends = 'id_pekerja';

    //cek apakah efektif primary dan appends dipakai, karena butuh untuk authenticable butuh juga untuk data

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //data bersifat bisa diisi
    protected $fillable = [
        'nama_pekerja', 'email', 'no_telp_pekerja', 'password'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'password'
    ];

    /**
     * Definisikan relasi ke model Proyek.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'pekerja_id');
    }
    
    /**
     * Definisikan relasi ke model Gaji.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gaji()
    {
        return $this->hasMany(Gaji::class, 'pekerja_id');
    }

}