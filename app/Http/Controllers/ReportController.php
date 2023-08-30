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

        $input1 = Input1::whereDate('created_at', $selectedDate)->get();
        $input2 = Input2::whereDate('created_at', $selectedDate)->get();
        $input3 = Input3::whereDate('created_at', $selectedDate)->get();

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
        $input1 = Input1::whereDate('created_at', $selectedDate)->get();
        $input2 = Input2::whereDate('created_at', $selectedDate)->get();
        $input3 = Input3::whereDate('created_at', $selectedDate)->get();

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
