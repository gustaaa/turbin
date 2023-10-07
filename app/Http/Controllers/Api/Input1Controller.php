<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use App\Http\Requests\Input1Request;
use App\Models\Input1;

class Input1Controller extends Controller
{
    use ApiResponse;
    public function index()
    {
        $user = auth()->user();

        // Mendapatkan waktu saat ini dalam format Jam
        $currentHour = now()->hour;

        // Menambahkan filter berdasarkan Jam created_at
        $input1 = Input1::with('user')
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
    public function store(Input1Request $request)
    {
        $request->validated();

        $user = auth()->user();
        $input1 = new Input1($request->all());
        $input1->user()->associate($user);
        $input1->save();

        return $this->apiSuccess($input1->load('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Input1  $input1
     * @return \Illuminate\Http\Response
     */
    public function show(Input1 $input1)
    {
        return $this->apiSuccess($input1->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Input1  $input1
     * @return \Illuminate\Http\Response
     */
    public function update(Input1Request $request, Input1 $input1)
    {
        $request->validated();
        $input1->inlet_steam = $request->inlet_steam;
        $input1->exm_steam = $request->exm_steam;
        $input1->turbin_thrust_bearing = $request->turbin_thrust_bearing;
        $input1->tb_gov_side = $request->tb_gov_side;
        $input1->tb_coup_side = $request->tb_coup_side;
        $input1->pb_tbn_side = $request->pb_tbn_side;
        $input1->pb_gen_side = $request->pb_gen_side;
        $input1->wb_tbn_side = $request->wb_tbn_side;
        $input1->wb_gen_side = $request->wb_gen_side;
        $input1->oc_lub_oil_outlet = $request->oc_lub_oil_outlet;

        $input1->save();
        return $this->apiSuccess($input1->load('user'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Input1  $input1
     * @return \Illuminate\Http\Response
     */
    public function destroy(Input1 $input1)
    {
        if (auth()->user()->id = $input1->user_id) {
            $input1->delete;
            return $this->apiSuccess($input1);
        }
        return $this->apiError(
            'Unautorized',
            Response::HTTP_UNAUTHORIZED
        );
    }
}
