<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Membagikan variabel global ke view layouts.admin
        View::composer('cms-admin.*', function ($admindata) {
            $admindata->with('nama_admin', Auth::user()->nama_admin);
        });

        // Membagikan variabel global ke view layouts.admin
        View::composer('layouts.admin', function ($admindata) {
            $admindata->with('nama_admin', Auth::user()->nama_admin);
        });

        // Membagikan variabel global ke view layouts.admin
        View::composer('pekerja.*', function ($pekerjadata) {
            $pekerjadata->with('nama_pekerja', Auth::user()->nama_pekerja);
        });

    }
}
