<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';

    protected $appends = 'id_layanan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_layanan', 'keterangan_layanan', 'foto_layanan', 'foto_layanan_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id_layanan'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'id_layanan'
    ];

    /**
     * Definisikan relasi ke model Proyek.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'layanan_id');
    }
}
