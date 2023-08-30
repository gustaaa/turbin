<?php

namespace App\Exports;

use App\Models\Input1;
use App\Models\Input2;
use App\Models\Input3;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class ReportExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $selectedDate;

    public function __construct($selectedDate)
    {
        $this->selectedDate = $selectedDate;
    }
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
        )->whereDate('created_at', $this->selectedDate)->get();

        $input2Data = Input2::Select(
            'turbin_speed',
            'rotor_vib_monitor',
            'axial_displacement_monitor',
            'main_steam',
            'stage_steam',
            'exhaust',
            'lub_oil',
            'control_oil'
        )->whereDate('created_at', $this->selectedDate)->get();

        $input3Data = Input3::Select(
            'temp_water_in',
            'temp_water_out',
            'temp_oil_in',
            'temp_oil_out',
            'vacum',
            'injector',
            'speed_drop',
            'load_limit',
            'flo_in',
            'flo_out'
        )->whereDate('created_at', $this->selectedDate)->get();
        // Combine the data from all three inputs
        $combinedData = collect([]);
        foreach ($input1Data as $key => $input1Row) {

            $combinedData->push(
                [
                    'created_at' => $input1Row->created_at->format('H:i:s'),
                    'inlet_steam' => $input1Row->inlet_steam,
                    'exm_steam' => $input1Row->exm_steam,
                    'turbin_thrust_bearing' => $input1Row->turbin_thrust_bearing,
                    'tb_gov_side' => $input1Row->tb_gov_side,
                    'tb_coup_side' => $input1Row->tb_coup_side,
                    'pb_tbn_side' => $input1Row->pb_tbn_side,
                    'pb_gen_side' => $input1Row->pb_gen_side,
                    'wb_tbn_side' => $input1Row->wb_tbn_side,
                    'wb_gen_side' => $input1Row->wb_gen_side,
                    'oc_lub_oil_outlet' => $input1Row->oc_lub_oil_outlet,
                    'turbin_speed' => $input2Data[$key]->turbin_speed,
                    'rotor_vib_monitor' => $input2Data[$key]->rotor_vib_monitor,
                    'axial_displacement_monitor' => $input2Data[$key]->axial_displacement_monitor,
                    'main_steam' => $input2Data[$key]->main_steam,
                    'stage_steam' => $input2Data[$key]->stage_steam,
                    'exhaust' => $input2Data[$key]->exhaust,
                    'lub_oil' => $input2Data[$key]->lub_oil,
                    'control_oil' => $input2Data[$key]->control_oil,
                    'temp_water_in' => $input3Data[$key]->temp_water_in,
                    'temp_water_out' => $input3Data[$key]->temp_water_out,
                    'temp_oil_in' => $input3Data[$key]->temp_oil_in,
                    'temp_oil_out' => $input3Data[$key]->temp_oil_out,
                    'vacum' => $input3Data[$key]->vacum,
                    'injector' => $input3Data[$key]->injector,
                    'speed_drop' => $input3Data[$key]->speed_drop,
                    'load_limit' => $input3Data[$key]->load_limit,
                    'flo_in' => $input3Data[$key]->flo_in,
                    'flo_out' => $input3Data[$key]->flo_out,
                ]
                // $input1Row->toArray() +
                //     $input2Data[$key]->toArray() +
                //     $input3Data[$key]->toArray()
            );
        }

        return $combinedData;
    }

    public function headings(): array
    {
        // Add the headings for all three inputs
        return [
            'created_at', // From Input1
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
            'turbin_speed', // From Input2
            'rotor_vib_monitor',
            'axial_displacement_monitor',
            'main_steam',
            'stage_steam',
            'exhaust',
            'lub_oil',
            'control_oil',
            'temp_water_in', // From Input3
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
