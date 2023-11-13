<?php

namespace App\Exports;

use App\Models\Input1;
use App\Models\Input2;
use App\Models\Input3;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class ReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithStyles
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

        $input2 = Input2::whereDate('created_at', $this->selectedDate)
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
        $input2Data = $input2->concat($input2Midnight);

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
        // Combine the data from all three inputs
        $combinedData = collect([]);
        $maxKey = max(count($input1), count($input2), count($input3));

        for ($key = 0; $key < $maxKey; $key++) {
            $data = [
                'created_at' => $input1[$key]->created_at->modify('+1 hour')->format('H:00'),
                'inlet_steam' => $input1[$key]->inlet_steam,
                'exm_steam' => $input1[$key]->exm_steam,
                'turbin_thrust_bearing' => $input1[$key]->turbin_thrust_bearing,
                'tb_gov_side' => $input1[$key]->tb_gov_side,
                'tb_coup_side' => $input1[$key]->tb_coup_side,
                'pb_tbn_side' => $input1[$key]->pb_tbn_side,
                'pb_gen_side' => $input1[$key]->pb_gen_side,
                'wb_tbn_side' => $input1[$key]->wb_tbn_side,
                'wb_gen_side' => $input1[$key]->wb_gen_side,
                'oc_lub_oil_outlet' => $input1[$key]->oc_lub_oil_outlet,
                'turbin_speed' => isset($input2[$key]) ? $input2[$key]->turbin_speed : null,
                'rotor_vib_monitor' => isset($input2[$key]) ? $input2[$key]->rotor_vib_monitor : null,
                'axial_displacement_monitor' => isset($input2[$key]) ? $input2[$key]->axial_displacement_monitor : null,
                'main_steam' => isset($input2[$key]) ? $input2[$key]->main_steam : null,
                'stage_steam' => isset($input2[$key]) ? $input2[$key]->stage_steam : null,
                'exhaust' => isset($input2[$key]) ? $input2[$key]->exhaust : null,
                'lub_oil' => isset($input2[$key]) ? $input2[$key]->lub_oil : null,
                'control_oil' => isset($input2[$key]) ? $input2[$key]->control_oil : null,
                'temp_water_in' => isset($input3[$key]) ? $input3[$key]->temp_water_in : null,
                'temp_water_out' => isset($input3[$key]) ? $input3[$key]->temp_water_out : null,
                'temp_oil_in' => isset($input3[$key]) ? $input3[$key]->temp_oil_in : null,
                'temp_oil_out' => isset($input3[$key]) ? $input3[$key]->temp_oil_out : null,
                'vacum' => isset($input3[$key]) ? $input3[$key]->vacum : null,
                'injector' => isset($input3[$key]) ? $input3[$key]->injector : null,
                'speed_drop' => isset($input3[$key]) ? $input3[$key]->speed_drop : null,
                'load_limit' => isset($input3[$key]) ? $input3[$key]->load_limit : null,
                'flo_in' => isset($input3[$key]) ? $input3[$key]->flo_in : null,
                'flo_out' => isset($input3[$key]) ? $input3[$key]->flo_out : null,
            ];

            $combinedData->push($data);
        }

        // Hitung rata-rata dan tambahkan ke data rata-rata
        if (!$combinedData->isEmpty()) {
            $columns = array_keys($combinedData->first());
            $columnsToAverage = array_slice($columns, 1);
            $averageRow = ['created_at' => 'Rata-rata'];

            foreach ($columnsToAverage as $column) {
                $columnData = $combinedData->pluck($column)->filter()->avg();
                $averageRow[$column] = $columnData;
            }

            $combinedData->push($averageRow);
        }

        return $combinedData;
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
                'Jam', // From Input1
                'Inlet Steam',
                'Exm Steam',
                'Turbin Thrust Bearing',
                'TB Gov Side',
                'TB Coup Side',
                'PB TBN Side',
                'PB Gen Side',
                'WB TBN Side',
                'WB Gen Side',
                'OC Lub Oil Outlet',
                'Turbin Speed', // From Input2
                'Rotor Vib Monitor',
                'Axial Dis Monitor',
                'Main Steam',
                'Stage Steam',
                'Exhaust',
                'Lub Oil',
                'Control Oil',
                'Temp Water In', // From Input3
                'Temp Water Out',
                'Temp Oil In',
                'Temp Oil Out',
                'Vacum',
                'Injector',
                'Speed Drop',
                'Load Limit',
                'FLO In',
                'FLO Out',
            ],
            [
                '', // From Input1
                '(°C)',
                '(°C)',
                '(°C)',
                '(°C)',
                '(°C)',
                '(°C)',
                '(°C)',
                '(°C)',
                '(°C)',
                '(°C)',
                '(RPM)', // From Input2
                '(mm)',
                '(mm)',
                '(kg/cm²G)',
                '(kg/cm²G)',
                '(kg/cm²G)',
                '(kg/cm²G)',
                '(kg/cm²G)',
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
                'Batas', // From Input1
                '450',
                '',
                '<70',
                '<70',
                '<70',
                '<70',
                '<70',
                '<70',
                '<70',
                '<50',
                '', // From Input2
                '0.08',
                '+0.5/-0.9',
                '45',
                '',
                '<1.7',
                '',
                '',
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
        $sheet->mergeCells('A1:AC1');
        $sheet->mergeCells('A2:AC2');
        $sheet->mergeCells('A3:AC3');
        $sheet->mergeCells('A4:AC4');

        $sheet->mergeCells('A5:A6');

        // Set horizontal and vertical alignment to center
        $sheet->getStyle('A:AC')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A:AC')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        // Make the text bold
        $sheet->getStyle('A1:AC3')->getFont()->setBold(true);

        // Apply borders to all cells
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A5:AC' . ($sheet->getHighestRow()))->applyFromArray($borderStyle);

        // Set the font size for the entire sheet to 10
        $sheet->getParent()->getDefaultStyle()->getFont()->setSize(6);

        // Set the font size for the data to 10 (same as the entire sheet)
        $sheet->getStyle('A5:AC' . ($sheet->getHighestRow()))->getFont()->setSize(6);

        // Center-align the data in all cells
        $sheet->getStyle('A5:AC' . ($sheet->getHighestRow()))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A5:AC5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A5:AC5')->getFill()->getStartColor()->setARGB('99CCFF');
        $sheet->getStyle('A6:AC6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A6:AC6')->getFill()->getStartColor()->setARGB('99CCFF');
        $sheet->getStyle('A7:AC7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A7:AC7')->getFill()->getStartColor()->setARGB('99CCFF');

        $columnWidth = 10; // Adjust the width as needed
        for ($col = 'A'; $col <= 'AC'; $col++) {
            $sheet->getColumnDimension($col)->setWidth($columnWidth);
        }
    }

    public function sheet(Worksheet $sheet)
    {
        // Set the print area to include all columns and rows
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $sheet->getPageSetup()->setPrintArea("A1:{$highestColumn}{$highestRow}");
        // Set the scaling options to fit to one page wide and tall
        $sheet->getPageSetup()->setFitToPage(true);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(1);
        $sheet->getPageMargins()->setLeft(0.1969);
        $sheet->getPageMargins()->setRight(0.1969);

        // Set a specific column width for all columns
        $columnWidth = 10; // Adjust the width as needed
        for ($col = 'A'; $col <= 'AC'; $col++) {
            $sheet->getColumnDimension($col)->setWidth($columnWidth);
        }

        // Enable text wrapping in cell A5
        $sheet->getStyle('A5')->getAlignment()->setWrapText(true);
    }
}
