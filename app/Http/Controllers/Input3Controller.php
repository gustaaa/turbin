<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Input3;

class Input3Controller extends Controller
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
        $input3 = $input3->concat($input3Midnight);
        return view('menu-input.input3.index', compact('input3', 'selectedDate'));
    }
    public function create()
    {
        return view('menu-input.input3.create');
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

        $input3 = new Input3;
        $input3->user_id = 2;
        $input3->temp_water_in = $request->get('temp_water_in');
        $input3->temp_water_out = $request->get('temp_water_out');
        $input3->temp_oil_in = $request->get('temp_oil_in');
        $input3->temp_oil_out = $request->get('temp_oil_out');
        $input3->vacum = $request->get('vacum');
        $input3->injector = $request->get('injector');
        $input3->speed_drop = $request->get('speed_drop');
        $input3->load_limit = $request->get('load_limit');
        $input3->flo_in = $request->get('flo_in');
        $input3->flo_out = $request->get('flo_out');

        $input3->save();
        return redirect(route('input3.index'))->with('success', 'Data Berhasil Ditambahkan');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $input3 = Input3::find($id);
        return view('menu-input.input3.show', compact('input3'));
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
        return view('menu-input.input3.edit', compact('input3'));
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

        $input3 = Input3::find($id)->update($request->all());
        $input3->save();
        $input3 = $input3->status;

        return redirect()->route('input3.index')->with('success', 'input3 Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $input3 = Input3::find($id);

        if ($input3) {
            $input3->delete();
            Alert::success('Success', 'Data berhasil dihapus');
        } else {
            Alert::error('Error', 'Data tidak ditemukan');
        }

        return redirect()->route('input3.index');
    }
}
