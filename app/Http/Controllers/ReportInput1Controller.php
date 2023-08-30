<?php

namespace App\Http\Controllers;

use App\Models\Input1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Input1Export;

use PDF;

class ReportInput1Controller extends Controller
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
        // mengambil data
        // Get the selected date from the request
        $selectedDate = $request->input('selected_date');

        // If selected date is not provided, default to today's date
        if (!$selectedDate) {
            $selectedDate = now()->format('Y-m-d');
        }
        $report1 = DB::table('input1')
            ->when($selectedDate, function ($query) use ($selectedDate) {
                return $query->whereDate('created_at', $selectedDate);
            })
            ->select(
                'id',
                DB::raw("DATE_FORMAT(created_at, '%H:%i') as created_at"),
                'inlet_steam',
                'exm_steam',
                'turbin_thrust_bearing',
                'tb_gov_side',
                'tb_coup_side',
                'pb_tbn_side',
                'pb_gen_side',
                'wb_tbn_side',
                'wb_gen_side',
                'oc_lub_oil_outlet'
            )
            ->paginate(10);
        return view('report.report1.index', compact('report1', 'selectedDate'));
    }
    public function laporan(Request $request)
    {
        $selectedDate = $request->input('selected_date');

        $report1 = Input1::when($selectedDate, function ($query) use ($selectedDate) {
            return $query->whereDate('created_at', $selectedDate);
        })->get();

        $pdf = PDF::loadview('report.report1.laporan', compact('report1', 'selectedDate'));
        return $pdf->stream();
    }
    public function export(Request $request)
    {
        $selectedDate = $request->input('selected_date', now()->format('Y-m-d'));

        return Excel::download(new Input1Export($selectedDate), 'input1_' . $selectedDate . '.xlsx');
    }
}
