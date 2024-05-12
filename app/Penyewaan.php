<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $table = 'penyewaan';

    protected $appends = 'id_penyewaan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'klien_id', 'harga_penyewaan', 'ket_tambahan', 'status_penyewaan', 'bukti_penyewaan', 'bukti_penyewaan_path', 'bukti_pengembalian', 'bukti_pengembalian_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id_penyewaan'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'id_penyewaan'
    ];
    
    public function klien()
    {
        return $this->belongsTo(Klien::class, 'klien_id');
    }
}
