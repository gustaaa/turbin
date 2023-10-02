<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InsertInput2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-input2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Cek apakah ada data sebelumnya dalam tabel input1
        $lastRecord = DB::table('input2')->latest('created_at')->first();

        // Tentukan waktu awal
        if ($lastRecord) {
            // Jika ada data sebelumnya, gunakan waktu terakhir dan tambahkan 1 jam
            $lastCreatedAt = Carbon::parse($lastRecord->created_at);
        } else {
            // Jika tabel kosong, gunakan waktu saat ini
            $lastCreatedAt = Carbon::now();
        }

        // Inisialisasi perulangan
        $i = 0;

        while ($i < 24) {
            // Menambahkan 1 jam pada waktu terakhir yang diinput
            $nextHour = $lastCreatedAt->copy()->addHour();

            // Memasukkan data dan mereset waktu jam terakhir
            DB::table('input2')->insert([
                'user_id' => 2,
                'turbin_speed' => 0,
                'rotor_vib_monitor' => 0,
                'axial_displacement_monitor' => 0,
                'main_steam' => 0,
                'stage_steam' => 0,
                'exhaust' => 0,
                'lub_oil' => 0,
                'control_oil' => 0,
                'created_at' => $nextHour,
                'updated_at' => $nextHour,
            ]);

            // Menggunakan waktu terbaru untuk perulangan berikutnya
            $lastCreatedAt = $nextHour;

            // Increment perulangan
            $i++;
        }
    }
}
