<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use App\Http\Requests\Input3Request;
use App\Models\Input3;

class Input3Controller extends Controller
{
    use ApiResponse;
    public function index()
    {
        $user = auth()->user();

        // Mendapatkan waktu saat ini dalam format Jam
        $currentHour = now()->hour;

        // Menambahkan filter berdasarkan Jam created_at
        $input1 = Input3::with('user')
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
    public function store(Input3Request $request)
    {
        $request->validated();

        $user = auth()->user();
        $input3 = new Input3($request->all());
        $input3->user()->associate($user);
        $input3->save();

        return $this->apiSuccess($input3->load('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Input3  $input3
     * @return \Illuminate\Http\Response
     */
    public function show(Input3 $input3)
    {
        return $this->apiSuccess($input3->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Input3  $input3
     * @return \Illuminate\Http\Response
     */
    public function update(Input3Request $request, Input3 $input3)
    {
        $request->validated();
        $input3->temp_water_in = $request->temp_water_in;
        $input3->temp_water_out = $request->temp_water_out;
        $input3->temp_oil_in = $request->temp_oil_in;
        $input3->temp_oil_out = $request->temp_oil_out;
        $input3->vacum = $request->vacum;
        $input3->injector = $request->injector;
        $input3->speed_drop = $request->speed_drop;
        $input3->load_limit = $request->load_limit;
        $input3->flo_in = $request->flo_in;
        $input3->flo_out = $request->flo_out;

        $input3->save();
        return $this->apiSuccess($input3->load('user'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Input3  $input3
     * @return \Illuminate\Http\Response
     */
    public function destroy(Input3 $input3)
    {
        if (auth()->user()->id = $input3->user_id) {
            $input3->delete;
            return $this->apiSuccess($input3);
        }
        return $this->apiError(
            'Unautorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
