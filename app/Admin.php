<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;

class Admin extends Authenticable
{
    //melindungi table
    protected $table = "admin";

    //melindungi admin
    protected $guard = 'admin';

    protected $primaryKey = 'id_admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //data bersifat bisa diisi
    protected $fillable = [
        'nama_admin', 'email_admin', 'no_telp_admin', 'password'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'password'
    ];
}
