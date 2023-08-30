<?php

namespace App\Exports;

use App\Models\Input2;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Input2Export implements FromCollection, WithHeadings, ShouldAutoSize
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
        $input2Data = Input2::Select(
            'created_at',
            'turbin_speed',
            'rotor_vib_monitor',
            'axial_displacement_monitor',
            'main_steam',
            'stage_steam',
            'exhaust',
            'lub_oil',
            'control_oil',
        )->whereDate('created_at', $this->selectedDate)->get();

        $formattedItem = $input2Data->map(function ($item) {
            return [
                'created_at' => $item->created_at->format('H:i:s'), // Format created_at to full datetime
                'turbin_speed' => $item->turbin_speed,
                'rotor_vib_monitor' => $item->rotor_vib_monitor,
                'axial_displacement_monitor' => $item->axial_displacement_monitor,
                'main_steam' => $item->main_steam,
                'stage_steam' => $item->stage_steam,
                'exhaust' => $item->exhaust,
                'lub_oil' => $item->lub_oil,
                'control_oil' => $item->control_oil,
            ];
        });
        return $formattedItem;
    }

    public function headings(): array
    {
        return [
            'batas',
            'turbin_speed',
            'rotor_vib_monitor',
            'axial_displacement_monitor',
            'main_steam',
            'stage_steam',
            'exhaust',
            'lub_oil',
            'control_oil',
        ];
    }
}
