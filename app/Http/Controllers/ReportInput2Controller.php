<?php

namespace App\Http\Controllers;

use App\Models\Input2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Input2Export;
use PDF;

class ReportInput2Controller extends Controller
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
        $report2 = DB::table('input2')
            ->when($selectedDate, function ($query) use ($selectedDate) {
                return $query->whereDate('created_at', $selectedDate);
            })
            ->select(
                'id',
                DB::raw("DATE_FORMAT(created_at, '%H:%i') as created_at"),
                'turbin_speed',
                'rotor_vib_monitor',
                'axial_displacement_monitor',
                'main_steam',
                'stage_steam',
                'exhaust',
                'lub_oil',
                'control_oil',
            )
            ->paginate(10);
        return view('report.report2.index', compact('report2', 'selectedDate'));
    }
    public function laporan(Request $request)
    {
        $selectedDate = $request->input('selected_date');

        $report2 = Input2::when($selectedDate, function ($query) use ($selectedDate) {
            return $query->whereDate('created_at', $selectedDate);
        })->get();

        $pdf = PDF::loadview('report.report2.laporan', compact('report2', 'selectedDate'));
        return $pdf->stream();
    }
    public function export(Request $request)
    {
        $selectedDate = $request->input('selected_date', now()->format('Y-m-d'));

        return Excel::download(new Input2Export($selectedDate), 'input2_' . $selectedDate . '.xlsx');
    }
}
