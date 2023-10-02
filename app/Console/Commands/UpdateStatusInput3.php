<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Input3;

class UpdateStatusInput3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status-input3';

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
        $data = Input3::all();

        foreach ($data as $item) {
            // Cek apakah ada setidaknya satu kolom yang bernilai selain 0
            $hasNonZeroColumn = false;

            $columnsToCheck = [
                'temp_water_in',
                'temp_water_out',
                'temp_oil_in',
                'temp_oil_out',
                'vacum',
                'injector',
                'speed_drop',
                'load_limit',
                'flo_in',
                'flo_out',
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
