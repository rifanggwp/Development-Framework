<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'proyek';

    protected $appends = 'id_proyek';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ket_tambahan', 'status_proyek'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id_proyek'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'id_proyek'
    ];
    
    /**
     * Definisikan relasi ke model Proyek Update.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proyekupdate()
    {
        return $this->hasMany(ProyekUpdate::class, 'proyek_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
    
    public function klien()
    {
        return $this->belongsTo(Klien::class, 'klien_id');
    }

    public function pekerja()
    {
        return $this->belongsTo(Pekerja::class, 'pekerja_id');
    }

    public function pemasukkan()
    {
        return $this->belongsTo(Pemasukkan::class, 'pekerja_id');
    }

    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class, 'pekerja_id');
    }
}
