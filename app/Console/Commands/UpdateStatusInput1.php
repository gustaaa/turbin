<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Input1;

class UpdateStatusInput1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status-input1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status for existing records';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating status for existing records...');

        // Ambil semua data dari tabel Input1
        $data = Input1::all();

        foreach ($data as $item) {
            // Cek apakah ada setidaknya satu kolom yang bernilai selain 0
            $hasNonZeroColumn = false;

            $columnsToCheck = [
                'inlet_steam',
                'exm_steam',
                'turbin_thrust_bearing',
                'tb_gov_side',
                'tb_coup_side',
                'pb_tbn_side',
                'pb_gen_side',
                'wb_tbn_side',
                'wb_gen_side',
                'oc_lub_oil_outlet',
            ];

            foreach ($columnsToCheck as $column) {
                if ($item->$column !== 0) {
                    $hasNonZeroColumn = true;
                    break;
                }
            }

            // Setel status sesuai dengan kondisi kolom-kolom
            $status = $hasNonZeroColumn ? 0 : 1;

            // Simpan pembaruan status ke dalam database
            $item->status = $status;
            $item->save();
        }

        $this->info('Status updated successfully.');
    }
}
