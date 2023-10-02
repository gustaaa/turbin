<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InsertInput1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-input1';

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
        $lastRecord = DB::table('input1')->latest('created_at')->first();

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
            DB::table('input1')->insert([
                'user_id' => 2,
                'inlet_steam' => 0,
                'exm_steam' => 0,
                'turbin_thrust_bearing' => 0,
                'tb_gov_side' => 0,
                'tb_coup_side' => 0,
                'pb_tbn_side' => 0,
                'pb_gen_side' => 0,
                'wb_tbn_side' => 0,
                'wb_gen_side' => 0,
                'oc_lub_oil_outlet' => 0,
                'status' => 0,
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
