<?php

namespace App\Exports;

use App\Models\Input3;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Input3Export implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle
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
            ['LOGSHEET TURBIN A/B'],
            ['DEPARTEMEN ELEKTRIK 2023'],
            ['PG GLENMORE'],
            [
                'Batas',
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
