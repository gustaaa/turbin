<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Input1;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class Input1Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
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
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Gabungkan data untuk jam 7 hingga 23 dan jam 0 hingga 6
        $input1 = $input1->concat($input1Midnight);
        return view('menu-input.input1.index', compact('input1', 'selectedDate'));
    }
    public function create()
    {
        return view('menu-input.input1.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $input1 = new Input1;
        $input1->user_id = 2;
        $input1->inlet_steam = $request->get('inlet_steam');
        $input1->exm_steam = $request->get('exm_steam');
        $input1->turbin_thrust_bearing = $request->get('turbin_thrust_bearing');
        $input1->tb_gov_side = $request->get('tb_gov_side');
        $input1->tb_coup_side = $request->get('tb_coup_side');
        $input1->pb_tbn_side = $request->get('pb_tbn_side');
        $input1->pb_gen_side = $request->get('pb_gen_side');
        $input1->wb_tbn_side = $request->get('wb_tbn_side');
        $input1->wb_gen_side = $request->get('wb_gen_side');
        $input1->oc_lub_oil_outlet = $request->get('oc_lub_oil_outlet');

        $input1->save();
        $input1 = $input1->status;
        return redirect(route('input1.index'))->with('success', 'Data Berhasil Ditambahkan');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $input1 = Input1::find($id);
        return view('menu-input.input1.show', compact('input1'));
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
        return view('menu-input.input1.edit', compact('input1'));
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

        $input1 = Input1::find($id);

        $input1->inlet_steam = $request->get('inlet_steam');
        $input1->exm_steam = $request->get('exm_steam');
        $input1->turbin_thrust_bearing = $request->get('turbin_thrust_bearing');
        $input1->tb_gov_side = $request->get('tb_gov_side');
        $input1->tb_coup_side = $request->get('tb_coup_side');
        $input1->pb_tbn_side = $request->get('pb_tbn_side');
        $input1->pb_gen_side = $request->get('pb_gen_side');
        $input1->wb_tbn_side = $request->get('wb_tbn_side');
        $input1->wb_gen_side = $request->get('wb_gen_side');
        $input1->oc_lub_oil_outlet = $request->get('oc_lub_oil_outlet');

        $input1->save();
        $input1 = $input1->status;
        return redirect()->route('input1.index')->with('success', 'Input1 Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $input1 = Input1::find($id);

        if ($input1) {
            $input1->delete();
            Alert::success('Success', 'Data berhasil dihapus');
        } else {
            Alert::error('Error', 'Data tidak ditemukan');
        }

        return redirect()->route('input1.index');
    }
}
