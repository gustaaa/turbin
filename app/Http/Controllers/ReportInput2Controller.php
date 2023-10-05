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
        $report2 = $input2->concat($input2Midnight);
        return view('report.report2.index', compact('report2', 'selectedDate'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $input2 = Input2::find($id);
        return view('report.report2.edit', compact('input2'));
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
            'turbin_speed' => 'required',
            'rotor_vib_monitor' => 'required',
            'axial_displacement_monitor' => 'required',
            'main_steam' => 'required',
            'stage_steam' => 'required',
            'exhaust' => 'required',
            'lub_oil' => 'required',
            'control_oil' => 'required',
        ]);

        Input2::find($id)->update($request->all());

        return redirect()->route('report2.index')->with('success', 'Input2 Berhasil Diupdate');
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
