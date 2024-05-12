<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    protected $appends = 'id_pengeluaran';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'proyek_id', 'nama_pengeluaran', 'keterangan_pengeluaran', 'bukti_pengeluaran', 'bukti_pengeluaran_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id_pengeluaran'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'id_pengeluaran'
    ];
    
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    public function gaji()
    {
        return $this->belongsTo(Gaji::class, 'gaji_id');
    }
}
