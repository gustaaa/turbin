<?php

namespace App\Http\Controllers;

use App\Models\Input3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Input3Export;
use PDF;

class ReportInput3Controller extends Controller
{
    public function index(Request $request)
    {
        // mengambil data
        // Get the selected date from the request
        $selectedDate = $request->input('selected_date');

        // If selected date is not provided, default to today's date
        if (!$selectedDate) {
            $selectedDate = now()->format('Y-m-d');
        }
        $report3 = DB::table('input3')
            ->when($selectedDate, function ($query) use ($selectedDate) {
                return $query->whereDate('created_at', $selectedDate);
            })
            ->select(
                'id',
                DB::raw("DATE_FORMAT(created_at, '%H:%i') as created_at"),
                'temp_water_in',
                'temp_water_out',
                'temp_oil_in',
                'temp_oil_out',
                'vacum',
                'injector',
                'speed_drop',
                'load_limit',
                'flo_in',
                'flo_out',
            )
            ->paginate(10);
        return view('report.report3.index', compact('report3', 'selectedDate'));
    }
    public function laporan(Request $request)
    {
        $selectedDate = $request->input('selected_date');

        $report3 = Input3::when($selectedDate, function ($query) use ($selectedDate) {
            return $query->whereDate('created_at', $selectedDate);
        })->get();

        $pdf = PDF::loadview('report.report3.laporan', compact('report3', 'selectedDate'));
        return $pdf->stream();
    }
    public function export(Request $request)
    {
        $selectedDate = $request->input('selected_date', now()->format('Y-m-d'));

        return Excel::download(new Input3Export($selectedDate), 'input3_' . $selectedDate . '.xlsx');
    }
}
