<?php

namespace App\Exports;

use App\Models\Input1;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Input1Export implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithStyles
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

    /**
     * @return \Illuminate\Support\Collection
     */
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
        $input1Data = $input1->concat($input1Midnight);

        $formattedData = $input1Data->map(function ($item) {
            return [
                'created_at' => $item->created_at->format('H:00'),
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
            ['LOGSHEET TURBIN A/B'],
            ['DEPARTEMEN ELEKTRIK 2023'],
            ['PG GLENMORE'],
            [
                'Batas',
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
            ],
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:K1');
        $sheet->mergeCells('A2:K2');
        $sheet->mergeCells('A3:K3');
        // Set horizontal alignment to center
        $sheet->getStyle('A1:K3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set vertical alignment to center
        $sheet->getStyle('A1:K3')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Make the text bold
        $sheet->getStyle('A1:K3')->getFont()->setBold(true);
    }
}
