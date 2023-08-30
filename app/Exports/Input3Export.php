<?php

namespace App\Exports;

use App\Models\Input3;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Input3Export implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $selectedDate;

    public function __construct($selectedDate)
    {
        $this->selectedDate = $selectedDate;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $input3Data = Input3::Select(
            'created_at',
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
        )->whereDate('created_at', $this->selectedDate)->get();

        return $input3Data->map(function ($item) {
            return [
                'created_at' => $item->created_at->format('H:i:s'), // Format created_at to match database format
                'temp_water_in' => $item->temp_water_in,
                'temp_water_out' => $item->temp_water_out,
                'temp_oil_in' => $item->temp_oil_in,
                'temp_oil_out' => $item->temp_oil_out,
                'vacum' => $item->vacum,
                'injector' => $item->injector,
                'speed_drop' => $item->speed_drop,
                'load_limit' => $item->load_limit,
                'flo_in' => $item->flo_in,
                'flo_out' => $item->flo_out,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'batas',
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
    }
}
