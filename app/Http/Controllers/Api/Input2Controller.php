<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use App\Http\Requests\Input2Request;
use App\Models\Input2;

class Input2Controller extends Controller
{
    use ApiResponse;
    public function index()
    {
        $user = auth()->user();

        // Mendapatkan waktu saat ini dalam format Jam
        $currentHour = now()->hour;

        // Menambahkan filter berdasarkan Jam created_at
        $input1 = Input2::with('user')
            ->where('user_id', $user->id)
            ->whereRaw('HOUR(created_at) = ?', [$currentHour]) // Menambahkan filter Jam
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan created_at
            ->limit(1) // Hanya mengambil 1 hasil terbaru
            ->get();

        return $this->apiSuccess($input1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Input2Request $request)
    {
        $request->validated();

        $user = auth()->user();
        $input2 = new Input2($request->all());
        $input2->user()->associate($user);
        $input2->save();

        return $this->apiSuccess($input2->load('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Input2  $input2
     * @return \Illuminate\Http\Response
     */
    public function show(Input2 $input2)
    {
        return $this->apiSuccess($input2->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Input2  $input2
     * @return \Illuminate\Http\Response
     */
    public function update(Input2Request $request, Input2 $input2)
    {
        $request->validated();
        $input2->turbin_speed = $request->turbin_speed;
        $input2->rotor_vib_monitor = $request->rotor_vib_monitor;
        $input2->axial_displacement_monitor = $request->axial_displacement_monitor;
        $input2->main_steam = $request->main_steam;
        $input2->stage_steam = $request->stage_steam;
        $input2->exhaust = $request->exhaust;
        $input2->lub_oil = $request->lub_oil;
        $input2->control_oil = $request->control_oil;

        $input2->save();
        return $this->apiSuccess($input2->load('user'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Input2  $input2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Input2 $input2)
    {
        if (auth()->user()->id = $input2->user_id) {
            $input2->delete;
            return $this->apiSuccess($input2);
        }
        return $this->apiError(
            'Unautorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
