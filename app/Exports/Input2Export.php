<?php

namespace App\Exports;

use App\Models\Input2;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Input2Export implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithStyles
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

        $formattedItem = $input2Data->map(function ($item) {
            return [
                'created_at' => $item->created_at->format('H:00'), // Format created_at to full datetime
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
            ['LOGSHEET TURBIN A/B'],
            ['DEPARTEMEN ELEKTRIK 2023'],
            ['PG GLENMORE'],
            [
                'Batas',
                'Turbin Speed', // From Input2
                'Rotor Vibrator Monitor',
                'Axial Displacement Monitor',
                'Main Steam',
                'Stage Steam',
                'Exhaust',
                'Lub Oil',
                'Control Oil',
            ]
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:I1');
        $sheet->mergeCells('A2:I2');
        $sheet->mergeCells('A3:I3');
        // Set horizontal alignment to center
        $sheet->getStyle('A1:I3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set vertical alignment to center
        $sheet->getStyle('A1:I3')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Make the text bold
        $sheet->getStyle('A1:I3')->getFont()->setBold(true);
    }
}
