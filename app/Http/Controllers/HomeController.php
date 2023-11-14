<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Input3;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
        // Load data for hours 7 to 23
        $input3 = Input3::whereDate('created_at', $selectedDate)
            ->whereTime('created_at', '>=', '06:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->get();

        $nextDate = Carbon::parse($selectedDate)->addDay();
        $input3Midnight = Input3::whereDate('created_at', $nextDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '05:59:59')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $home = $input3->concat($input3Midnight);
        $tempWaterIn = $input3->concat($input3Midnight)->pluck('temp_water_in');
        $tempWaterOut = $input3->concat($input3Midnight)->pluck('temp_water_out');
        $tempOilIn = $input3->concat($input3Midnight)->pluck('temp_oil_in');
        $tempOilOut = $input3->concat($input3Midnight)->pluck('temp_oil_out');
        $batasMidnight = $input3->concat($input3Midnight)->pluck('created_at')->map(function ($datetime) {
            return \Carbon\Carbon::parse($datetime)->modify('+1 hour')->format('H:00');
        });
        return view('home', compact('home', 'selectedDate', 'tempWaterIn', 'tempWaterOut', 'tempOilIn', 'tempOilOut', 'batasMidnight'));
    }

    public function rentangA()
    {
        // Hitung tanggal awal sebagai 15 hari yang lalu dari hari ini
        $startDate = now()->startOfMonth(); // Mengambil awal bulan ini

        // Hitung tanggal akhir sebagai 15 hari setelah tanggal awal
        $endDate = $startDate->copy()->addDays(14); // Mengambil tanggal setelah 15 hari

        // Load data for the specified date range
        $data = Input3::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->selectRaw('DATE(created_at) as date, AVG(temp_water_in) as avg_temp_water_in, AVG(temp_water_out) as avg_temp_water_out, AVG(temp_oil_in) as avg_temp_oil_in, AVG(temp_oil_out) as avg_temp_oil_out')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $dashboard = $data;
        $dates = $data->pluck('date');
        $tempWaterIn = $data->pluck('avg_temp_water_in');
        $tempWaterOut = $data->pluck('avg_temp_water_out');
        $tempOilIn = $data->pluck('avg_temp_oil_in');
        $tempOilOut = $data->pluck('avg_temp_oil_out');

        return view('dashboardA', compact('dashboard', 'dates', 'tempWaterIn', 'tempWaterOut', 'tempOilIn', 'tempOilOut'));
    }
    public function rentangB()
    {
        // Hitung tanggal awal sebagai 15 hari yang lalu dari hari ini
        $startDate = now()->startOfMonth()->addDays(15); // Mengambil awal bulan ini

        // Hitung tanggal akhir sebagai 15 hari setelah tanggal awal
        $endDate = now()->endOfMonth(); // Mengambil tanggal setelah 15 hari

        // Load data for the specified date range
        $data = Input3::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->selectRaw('DATE(created_at) as date, AVG(temp_water_in) as avg_temp_water_in, AVG(temp_water_out) as avg_temp_water_out, AVG(temp_oil_in) as avg_temp_oil_in, AVG(temp_oil_out) as avg_temp_oil_out')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Combine the data for hours 7 to 23 and hours 0 to 6
        $dashboard = $data;
        $dates = $data->pluck('date');
        $tempWaterIn = $data->pluck('avg_temp_water_in');
        $tempWaterOut = $data->pluck('avg_temp_water_out');
        $tempOilIn = $data->pluck('avg_temp_oil_in');
        $tempOilOut = $data->pluck('avg_temp_oil_out');

        return view('dashboardB', compact('dashboard', 'dates', 'tempWaterIn', 'tempWaterOut', 'tempOilIn', 'tempOilOut'));
    }
}
