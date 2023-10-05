<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Input1;
use App\Models\Input2;
use App\Models\Input3;
use App\Models\Report;
use PDF;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectedDate = $request->input('selected_date');

        // If selected date is not provided, default to today's date
        if (!$selectedDate) {
            $selectedDate = now()->format('Y-m-d');
        }

        // Load data for hours 7 to 23
        $input1 = Input1::whereDate('created_at', $selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Load data for hours 0 to 6, but consider it as a previous day's data
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        // Load data for hours 0 to 6, but consider it as a next day's data
        $nextDate = Carbon::parse($selectedDate)->addDay();
        $input1Midnight = Input1::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $input1 = $input1->concat($input1Midnight);
        // Load data for hours 7 to 23
        $input2 = Input2::whereDate('created_at', $selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Load data for hours 0 to 6, but consider it as a previous day's data
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        // Load data for hours 0 to 6, but consider it as a next day's data
        $nextDate = Carbon::parse($selectedDate)->addDay();
        $input2Midnight = Input2::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $input2 = $input2->concat($input2Midnight);

        // Load data for hours 7 to 23
        $input3 = Input3::whereDate('created_at', $selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Load data for hours 0 to 6, but consider it as a previous day's data
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        // Load data for hours 0 to 6, but consider it as a next day's data
        $nextDate = Carbon::parse($selectedDate)->addDay();
        $input3Midnight = Input3::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $input3 = $input3->concat($input3Midnight);

        return view('report.index', compact('input1', 'input2', 'input3', 'selectedDate'));
    }

    public function laporan(Request $request)
    {
        $selectedDate = $request->input('selected_date');

        // If selected date is not provided, default to today's date
        if (!$selectedDate) {
            $selectedDate = now()->format('Y-m-d');
        }

        $report = Report::whereDate('created_at', $selectedDate)->get();
        // Load data for hours 7 to 23
        $input1 = Input1::whereDate('created_at', $selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Load data for hours 0 to 6, but consider it as a previous day's data
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        // Load data for hours 0 to 6, but consider it as a next day's data
        $nextDate = Carbon::parse($selectedDate)->addDay();
        $input1Midnight = Input1::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $input1 = $input1->concat($input1Midnight);

        // Load data for hours 7 to 23
        $input2 = Input2::whereDate('created_at', $selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Load data for hours 0 to 6, but consider it as a previous day's data
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        // Load data for hours 0 to 6, but consider it as a next day's data
        $nextDate = Carbon::parse($selectedDate)->addDay();
        $input2Midnight = Input2::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $input2 = $input2->concat($input2Midnight);

        // Load data for hours 7 to 23
        $input3 = Input3::whereDate('created_at', $selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Load data for hours 0 to 6, but consider it as a previous day's data
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        // Load data for hours 0 to 6, but consider it as a next day's data
        $nextDate = Carbon::parse($selectedDate)->addDay();
        $input3Midnight = Input3::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $input3 = $input3->concat($input3Midnight);

        $pdf = PDF::loadview('report.laporan', compact('report', 'input1', 'input2', 'input3', 'selectedDate'));
        return $pdf->stream();
    }
    public function export(Request $request)
    {
        $selectedDate = $request->input('selected_date', now()->format('Y-m-d'));
        $fileName = 'logsheet-turbin-' . $selectedDate . '.xlsx';
        return Excel::download(new ReportExport($selectedDate), $fileName);
    }
}
