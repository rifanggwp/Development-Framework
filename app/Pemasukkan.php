<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukkan extends Model
{
    protected $table = 'pemasukkan';

    protected $appends = 'id_pemasukkan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'proyek_id', 'penyewaan_id', 'keterangan_pemasukkan', 'bukti_pemasukkan', 'bukti_pemasukkan_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id_pemasukkan'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'id_pemasukkan'
    ];
    
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'penyewaan_id');
    }
}
