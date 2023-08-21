<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('double', function ($attribute, $value, $parameters, $validator) {
            // Implementasi logika validasi angka pecahan di sini
            return is_numeric($value) && strpos($value, '.') !== false;
        });
        Schema::defaultStringLength(191); // Sesuaikan dengan kebutuhan Anda

        // Mengatur zona waktu default
        date_default_timezone_set('Asia/Jakarta'); // Ganti 'Asia/Jakarta' dengan zona waktu yang sesuai
    }
}
