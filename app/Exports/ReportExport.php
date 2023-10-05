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
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle
{
    protected $selectedDate;

    public function __construct($selectedDate)
    {
        $this->selectedDate = $selectedDate;
    }
    public function title(): string
    {
        return "LOGSHEET TURBIN A / B";
    }
    public function collection()
    {
        // Load data for hours 7 to 23
        $input1 = Input1::whereDate('created_at', $this->selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Load data for hours 0 to 6, but consider it as a previous day's data
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        // Load data for hours 0 to 6, but consider it as a next day's data
        $nextDate = Carbon::parse($this->selectedDate)->addDay();
        $input1Midnight = Input1::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $input1 = $input1->concat($input1Midnight);

        $input2Data = Input2::whereDate('created_at', $this->selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Load data for hours 0 to 6, but consider it as a previous day's data
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        // Load data for hours 0 to 6, but consider it as a next day's data
        $nextDate = Carbon::parse($this->selectedDate)->addDay();
        $input2Midnight = Input2::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $input2Data = $input2Data->concat($input2Midnight);

        $input3 = Input3::whereDate('created_at', $this->selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Load data for hours 0 to 6, but consider it as a previous day's data
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        // Load data for hours 0 to 6, but consider it as a next day's data
        $nextDate = Carbon::parse($this->selectedDate)->addDay();
        $input3Midnight = Input3::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $input3Data = $input3->concat($input3Midnight);
        // Combine the data from all three inputs
        $combinedData = collect([]);
        foreach ($input1 as $key => $input1Row) {

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
            ['LOGSHEET TURBIN A/B'],
            ['DEPARTEMEN ELEKTRIK 2023'],
            ['PG GLENMORE'],
            [
                'Batas', // From Input1
                'Inlet Steam',
                'Exm Steam',
                'Turbin Thrust Bearing',
                'Turbin Bearing Gov Side',
                'Turbin Bearing Coup Side',
                'Pinion Bearing TBN Side',
                'Pinion Bearing Gen Side',
                'Wheel Bearing TBN Side',
                'Wheel Bearing Gen Side',
                'Oil Control Lub Oil Outlet',
                'Turbin Speed', // From Input2
                'Rotor Vibrator Monitor',
                'Axial Displacement Monitor',
                'Main Steam',
                'Stage Steam',
                'Exhaust',
                'Lub Oil',
                'Control Oil',
                'Temperature Water In', // From Input3
                'Temperature Water Out',
                'Temperature Oil In',
                'Temperature Oil Out',
                'Vacum',
                'Injector',
                'Speed Drop',
                'Load Limit',
                'FLO In',
                'FLO Out',
            ]
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->mergeCells('A1:K1');
                $event->sheet->getDelegate()->mergeCells('A2:K2');
                $event->sheet->getDelegate()->mergeCells('A3:K3');

                // Tambahkan pemformatan penataan sel secara eksplisit
                $event->sheet->getDelegate()->getStyle('A1:K3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:K3')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            },
        ];
    }
}
