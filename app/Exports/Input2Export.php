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
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

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
        $formattedDate = $this->selectedDate;
        // Add the headings for all three inputs
        return [
            ['LOGSHEET TURBIN A/B'],
            ['DEPARTEMEN ELEKTRIK 2023'],
            ['PG GLENMORE'],
            ['Tanggal: ' . $formattedDate],
            [
                'Jam',
                'Turbin Speed', // From Input2
                'Rotor Vibrator Monitor',
                'Axial Displacement Monitor',
                'Main Steam',
                'Stage Steam',
                'Exhaust',
                'Lub Oil',
                'Control Oil',
            ], [
                '',
                '(RPM)', // From Input2
                '(mm)',
                '(mm)',
                '(kg/cm²G)',
                '(kg/cm²G)',
                '(kg/cm²G)',
                '(kg/cm²G)',
                '(kg/cm²G)',
            ], [
                'Batas',
                '', // From Input2
                '0.08',
                '+0.5/-0.9',
                '45',
                '',
                '<1.7',
                '',
                '',
            ]
        ];
    }
    public function styles(Worksheet $sheet)
    {
        // Set the paper size to A3
        $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A3);

        // Set the orientation to landscape
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        // Merge cells for title and headings (if needed)
        $sheet->mergeCells('A1:I1');
        $sheet->mergeCells('A2:I2');
        $sheet->mergeCells('A3:I3');
        $sheet->mergeCells('A4:I4');

        $sheet->mergeCells('A5:A6');

        // Set horizontal and vertical alignment to center
        $sheet->getStyle('A:I')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A:I')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        // Make the text bold
        $sheet->getStyle('A1:I3')->getFont()->setBold(true);

        // Apply borders to all cells
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A5:I' . ($sheet->getHighestRow()))->applyFromArray($borderStyle);

        // Set the font size for the entire sheet to 10
        $sheet->getParent()->getDefaultStyle()->getFont()->setSize(6);

        // Set the font size for the data to 10 (same as the entire sheet)
        $sheet->getStyle('A5:I' . ($sheet->getHighestRow()))->getFont()->setSize(6);

        // Center-align the data in all cells
        $sheet->getStyle('A5:I' . ($sheet->getHighestRow()))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A5:I5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A5:I5')->getFill()->getStartColor()->setARGB('99CCFF');
        $sheet->getStyle('A6:I6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A6:I6')->getFill()->getStartColor()->setARGB('99CCFF');
        $sheet->getStyle('A7:I7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A7:I7')->getFill()->getStartColor()->setARGB('99CCFF');
    }
}
