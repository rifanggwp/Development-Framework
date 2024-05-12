<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyekUpdate extends Model
{
    protected $table = 'proyek_update';

    protected $appends = 'id_update';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'proyek_id', 'keterangan_update', 'bukti_update', 'bukti_update_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id_update'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'id_update'
    ];

    public function proyekupdate()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }
}
