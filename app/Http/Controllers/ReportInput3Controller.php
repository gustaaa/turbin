<?php

namespace App\Http\Controllers;

use App\Models\Input3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
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
        $report3 = $input3->concat($input3Midnight);
        return view('report.report3.index', compact('report3', 'selectedDate'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $input3 = Input3::find($id);
        return view('report.report3.edit', compact('input3'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'temp_water_in' => 'required',
            'temp_water_out' => 'required',
            'temp_oil_in' => 'required',
            'temp_oil_out' => 'required',
            'vacum' => 'required',
            'injector' => 'required',
            'speed_drop' => 'required',
            'load_limit' => 'required',
            'flo_in' => 'required',
            'flo_out' => 'required',
        ]);

        Input3::find($id)->update($request->all());

        return redirect()->route('report3.index')->with('success', 'input3 Berhasil Diupdate');
    }
    public function laporan(Request $request)
    {
        $selectedDate = $request->input('selected_date');

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
        $report3 = $input3->concat($input3Midnight);

        $pdf = PDF::loadview('report.report3.laporan', compact('report3', 'selectedDate'));
        return $pdf->stream();
    }
    public function export(Request $request)
    {
        $selectedDate = $request->input('selected_date', now()->format('Y-m-d'));

        return Excel::download(new Input3Export($selectedDate), 'input3_' . $selectedDate . '.xlsx');
    }
}
