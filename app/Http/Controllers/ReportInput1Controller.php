<?php

namespace App\Http\Controllers;

use App\Models\Input1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Input1Export;
use Illuminate\Support\Carbon;
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

        // Ambil data untuk jam 7 hingga 23
        $input1 = Input1::whereDate('created_at', $selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Ambil data untuk jam 0 hingga 6 dan anggap sebagai data hari sebelumnya
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        $nextDate = Carbon::parse($selectedDate)->addDay();
        $input1Midnight = Input1::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:00:00')
            ->get();

        // Gabungkan data untuk jam 7 hingga 23 dan jam 0 hingga 6
        $report1 = $input1->concat($input1Midnight);

        return view('report.report1.index', compact('report1', 'selectedDate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $input1 = Input1::find($id);
        return view('report.report1.edit', compact('input1'));
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
            'inlet_steam' => 'required',
            'exm_steam' => 'required',
            'turbin_thrust_bearing' => 'required',
            'tb_gov_side' => 'required',
            'tb_coup_side' => 'required',
            'pb_tbn_side' => 'required',
            'pb_gen_side' => 'required',
            'wb_tbn_side' => 'required',
            'wb_gen_side' => 'required',
            'oc_lub_oil_outlet' => 'required',
        ]);

        Input1::find($id)->update($request->all());

        return redirect()->route('report1.index')->with('success', 'Input1 Berhasil Diupdate');
    }
    public function laporan(Request $request)
    {
        $selectedDate = $request->input('selected_date');

        // Ambil data untuk jam 7 hingga 23
        $input1 = Input1::whereDate('created_at', $selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        // Ambil data untuk jam 0 hingga 6 dan anggap sebagai data hari sebelumnya
        // $previousDate = Carbon::parse($selectedDate)->subDay();
        $nextDate = Carbon::parse($selectedDate)->addDay();
        $input1Midnight = Input1::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:00:00')
            ->get();

        // Gabungkan data untuk jam 7 hingga 23 dan jam 0 hingga 6
        $report1 = $input1->concat($input1Midnight);

        $pdf = PDF::loadview('report.report1.laporan', compact('report1', 'selectedDate'));
        return $pdf->stream();
    }
    public function export(Request $request)
    {
        $selectedDate = $request->input('selected_date', now()->format('Y-m-d'));

        return Excel::download(new Input1Export($selectedDate), 'input1_' . $selectedDate . '.xlsx');
    }
}
