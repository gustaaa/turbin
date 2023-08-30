<?php

namespace App\Exports;

use App\Models\Input1;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Input1Export implements FromCollection, WithHeadings, ShouldAutoSize
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
        $input1Data = Input1::Select(
            'created_at',
            'inlet_steam',
            'exm_steam',
            'turbin_thrust_bearing',
            'tb_gov_side',
            'tb_coup_side',
            'pb_tbn_side',
            'pb_gen_side',
            'wb_tbn_side',
            'wb_gen_side',
            'oc_lub_oil_outlet'
        )->whereDate('created_at', $this->selectedDate)
            ->get();

        $formattedData = $input1Data->map(function ($item) {
            return [
                'created_at' => $item->created_at->format('H:i:s'),
                'inlet_steam' => $item->inlet_steam,
                'exm_steam' => $item->exm_steam,
                'turbin_thrust_bearing' => $item->turbin_thrust_bearing,
                'tb_gov_side' => $item->tb_gov_side,
                'tb_coup_side' => $item->tb_coup_side,
                'pb_tbn_side' => $item->pb_tbn_side,
                'pb_gen_side' => $item->pb_gen_side,
                'wb_tbn_side' => $item->wb_tbn_side,
                'wb_gen_side' => $item->wb_gen_side,
                'oc_lub_oil_outlet' => $item->oc_lub_oil_outlet,
            ];
        });

        return $formattedData;
    }
    public function headings(): array
    {
        return [
            'batas',
            'inlet_steam',
            'exm_steam',
            'turbin_thrust_bearing',
            'tb_gov_side',
            'tb_coup_side',
            'pb_tbn_side',
            'pb_gen_side',
            'wb_tbn_side',
            'wb_gen_side',
            'oc_lub_oil_outlet'
        ];
    }
}
