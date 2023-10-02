<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Input2;
use RealRashid\SweetAlert\Facades\Alert;

class Input2Controller extends Controller
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
        $input2 = DB::table('input2')
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
            ->paginate(24);
        return view('menu-input.input2.index', compact('input2', 'selectedDate'));
    }
    public function create()
    {
        return view('menu-input.input2.create');
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
            'turbin_speed' => 'required',
            'rotor_vib_monitor' => 'required',
            'axial_displacement_monitor' => 'required',
            'main_steam' => 'required',
            'stage_steam' => 'required',
            'exhaust' => 'required',
            'lub_oil' => 'required',
            'control_oil' => 'required',
        ]);

        $input2 = new Input2;
        $input2->user_id = 2;
        $input2->turbin_speed = $request->get('turbin_speed');
        $input2->rotor_vib_monitor = $request->get('rotor_vib_monitor');
        $input2->axial_displacement_monitor = $request->get('axial_displacement_monitor');
        $input2->main_steam = $request->get('main_steam');
        $input2->stage_steam = $request->get('stage_steam');
        $input2->exhaust = $request->get('exhaust');
        $input2->lub_oil = $request->get('lub_oil');
        $input2->control_oil = $request->get('control_oil');

        $input2->save();
        return redirect(route('input2.index'))->with('success', 'Data Berhasil Ditambahkan');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $input2 = Input2::find($id);
        return view('menu-input.input2.show', compact('input2'));
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
        return view('menu-input.input2.edit', compact('input2'));
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

        $input2 = Input2::find($id)->update($request->all());
        $input2->save();
        $input2 = $input2->status;
        return redirect()->route('input2.index')->with('success', 'Input2 Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $input2 = Input2::find($id);

        if ($input2) {
            $input2->delete();
            Alert::success('Success', 'Data berhasil dihapus');
        } else {
            Alert::error('Error', 'Data tidak ditemukan');
        }

        return redirect()->route('input2.index');
    }
}
