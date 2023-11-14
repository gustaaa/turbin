<?php

namespace App\Exports;

use App\Models\Input3;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class Input3Export implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithStyles
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

        return $input3Data->map(function ($item) {
            return [
                'created_at' => $item->created_at->format('H:00'), // Format created_at to match database format
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
        $formattedDate = $this->selectedDate;
        // Add the headings for all three inputs
        return [
            ['LOGSHEET TURBIN A/B'],
            ['DEPARTEMEN ELEKTRIK 2023'],
            ['PG GLENMORE'],
            ['Tanggal: ' . $formattedDate],
            [
                'Jam',
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
            ],
            [
                '',
                '(°C)', // From Input3
                '(°C)',
                '(°C)',
                '(°C)',
                '',
                '',
                '',
                '',
                '',
                '',
            ],
            [
                'Batas',
                '', // From Input3
                '',
                '',
                '',
                '',
                '',
                '',
                '',
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
        $sheet->mergeCells('A1:K1');
        $sheet->mergeCells('A2:K2');
        $sheet->mergeCells('A3:K3');
        $sheet->mergeCells('A4:K4');

        $sheet->mergeCells('A5:A6');

        // Set horizontal and vertical alignment to center
        $sheet->getStyle('A:K')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A:K')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        // Make the text bold
        $sheet->getStyle('A1:K3')->getFont()->setBold(true);

        // Apply borders to all cells
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A5:K' . ($sheet->getHighestRow()))->applyFromArray($borderStyle);

        // Set the font size for the entire sheet to 10
        $sheet->getParent()->getDefaultStyle()->getFont()->setSize(6);

        // Set the font size for the data to 10 (same as the entire sheet)
        $sheet->getStyle('A5:K' . ($sheet->getHighestRow()))->getFont()->setSize(6);

        // Center-align the data in all cells
        $sheet->getStyle('A5:K' . ($sheet->getHighestRow()))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A5:K5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A5:K5')->getFill()->getStartColor()->setARGB('99CCFF');
        $sheet->getStyle('A6:K6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A6:K6')->getFill()->getStartColor()->setARGB('99CCFF');
        $sheet->getStyle('A7:K7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A7:K7')->getFill()->getStartColor()->setARGB('99CCFF');
    }
}
