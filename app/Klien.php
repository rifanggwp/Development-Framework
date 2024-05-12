<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    protected $table = 'klien';

    protected $appends = 'id_klien';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_klien', 'email_klien', 'no_telp_klien', 'alamat_klien'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id_klien'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'id_klien'
    ];

    /**
     * Definisikan relasi ke model Proyek.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'klien_id');
    }

    /**
     * Definisikan relasi ke model Penyewaan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penyewaan()
    {
        return $this->hasMany(Penyewaan::class, 'klien_id');
    }

    /**
     * Definisikan relasi ke model Pemasukkan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pemasukkan()
    {
        return $this->hasMany(Pemasukkan::class, 'klien_id');
    }
}
