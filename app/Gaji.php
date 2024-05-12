<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';

    protected $appends = 'id_gaji';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pekerja_id', 'proyek_id', 'jumlah_gaji', 'status_gaji', 'bukti_gaji', 'bukti_gaji_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id_gaji'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'id_gaji'
    ];
    
    public function pekerja()
    {
        return $this->belongsTo(Pekerja::class, 'pekerja_id');
    }
}
