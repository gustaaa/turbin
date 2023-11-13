<!DOCTYPE html>
<html>

<head>
    <title>Print Laporan Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
        /* Tambahkan CSS sesuai kebutuhan Anda untuk mengatur tampilan dalam orientasi landscape */
        @page {
            size: A3 landscape;
            /* Mengatur ukuran A3 dalam orientasi landscape */
        }


        body {
            font-size: 12px;
            /* Atur ukuran font */
        }

        .table th,
        .table td {
            padding: 6px;
            /* Atur padding sel dalam tabel */
            font-size: 8px;
            /* Atur ukuran font sel dalam tabel */
        }

        .center-text {
            text-align: center;
        }

        .custom-heading {
            font-size: 10px;
            text-align: left;
        }

        .table th.column-header {
            background-color: lightgray;
        }

        /* Tambahkan properti CSS tambahan sesuai kebutuhan */
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-12 margin-tb">
            <div class="pull-left mt-2">
                <h5 class="center-text">LOGSHEET TURBIN A/B</h5>
                <h5 class="center-text">DEPARTEMEN ELEKTRIK 2023</h5>
                <h5 class="center-text">PG GLENMORE</h5>
            </div>
            <div class="pull-right">
                <h3 class="custom-heading">Tanggal: {{ $selectedDate }}</h3>
            </div>
            <br>
            <table class="table table-bordered">
                <tr>
                    <th rowspan="2" class="center-text text-center column-header" style="vertical-align: middle;">Jam</th>
                    <th class="text-center column-header">Inlet Steam</th>
                    <th class="text-center column-header">Exm Steam</th>
                    <th class="text-center column-header">Turbin thrust bearing</th>
                    <th class="text-center column-header">TB Gov Side</th>
                    <th class="text-center column-header">TB Coup Side</th>
                    <th class="text-center column-header">PB tbn side</th>
                    <th class="text-center column-header">PB gen side</th>
                    <th class="text-center column-header">WB tbn side</th>
                    <th class="text-center column-header">WB gen side</th>
                    <th class="text-center column-header">OC lub oil outlet</th>
                    <th class="text-center column-header">Turbin Speed</th>
                    <th class="text-center column-header">Rotor Vib Monitor</th>
                    <th class="text-center column-header">Axial Dis Monitor</th>
                    <th class="text-center column-header">Main Steam</th>
                    <th class="text-center column-header">Stage Steam</th>
                    <th class="text-center column-header">Exhaust</th>
                    <th class="text-center column-header">Lub Oil</th>
                    <th class="text-center column-header">Control Oil</th>
                    <th class="text-center column-header">Temp Water In</th>
                    <th class="text-center column-header">Temp Water Out</th>
                    <th class="text-center column-header">Temp Oil In</th>
                    <th class="text-center column-header">Temp Oil Out</th>
                    <th class="text-center column-header">Vacum</th>
                    <th class="text-center column-header">Injector</th>
                    <th class="text-center column-header">Speed Drop</th>
                    <th class="text-center column-header">Load Limit</th>
                    <th class="text-center column-header">FLO In</th>
                    <th class="text-center column-header">FLO Out</th>
                </tr>
                <tr>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(RPM)</th>
                    <th class="text-center column-header">(mm)</th>
                    <th class="text-center column-header">(mm)</th>
                    <th class="text-center column-header">(Kg/Cm&sup2;G)</th>
                    <th class="text-center column-header">(Kg/Cm&sup2;G)</th>
                    <th class="text-center column-header">(Kg/Cm&sup2;G)</th>
                    <th class="text-center column-header">(Kg/Cm&sup2;G)</th>
                    <th class="text-center column-header">(Kg/Cm&sup2;G)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header">(&deg;C)</th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                </tr>
                <tr>
                    <th class="text-center column-header">Batas</th>
                    <th class="text-center column-header">450</th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header">>70</th>
                    <th class="text-center column-header">>70</th>
                    <th class="text-center column-header">>70</th>
                    <th class="text-center column-header">>70</th>
                    <th class="text-center column-header">>70</th>
                    <th class="text-center column-header">>70</th>
                    <th class="text-center column-header">>70</th>
                    <th class="text-center column-header">50</th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header">0.08</th>
                    <th class="text-center column-header">+0.5/-0.9</th>
                    <th class="text-center column-header">45</th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header">0.7</th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                </tr>
                @php
                // Menentukan jumlah maksimum baris di antara array input
                $totalData = max(count($input1), count($input2), count($input3));

                // Inisialisasi array untuk menyimpan nilai kolom dan hitungan
                $columns = array(
                'inlet_steam' => 0,
                'exm_steam' => 0,
                'turbin_thrust_bearing' => 0,
                'tb_gov_side' => 0,
                'tb_coup_side' => 0,
                'pb_tbn_side' => 0,
                'pb_gen_side' => 0,
                'wb_tbn_side' => 0,
                'wb_gen_side' => 0,
                'oc_lub_oil_outlet' => 0,
                'turbin_speed' => 0,
                'rotor_vib_monitor' => 0,
                'axial_displacement_monitor' => 0,
                'main_steam' => 0,
                'stage_steam' => 0,
                'exhaust' => 0,
                'lub_oil' => 0,
                'control_oil' => 0,
                'temp_water_in' => 0,
                'temp_water_out' => 0,
                'temp_oil_in' => 0,
                'temp_oil_out' => 0,
                'vacum' => 0,
                'injector' => 0,
                'speed_drop' => 0,
                'load_limit' => 0,
                'flo_in' => 0,
                'flo_out' => 0
                );

                // Melalui data dan mengakumulasi nilai untuk setiap kolom
                for ($i = 0; $i < $totalData; $i++) { if (isset($input1[$i])) { foreach ($columns as $key=> $value) {
                    $columns[$key] += $input1[$i]->$key;
                    }
                    }
                    if (isset($input2[$i])) {
                    foreach ($columns as $key => $value) {
                    $columns[$key] += $input2[$i]->$key;
                    }
                    }
                    if (isset($input3[$i])) {
                    foreach ($columns as $key => $value) {
                    $columns[$key] += $input3[$i]->$key;
                    }
                    }
                    }

                    // Menghitung rata-rata untuk setiap kolom
                    $columnCount = count($columns);
                    foreach ($columns as $key => $value) {
                    $columns[$key] = $value / $columnCount;
                    }
                    @endphp
                    @for($i = 0; $i < $totalData; $i++) <tr>
                        @if(isset($input1[$i]))
                        <td class="text-center">{{$input1[$i]->created_at->modify('+1 hour')->format('H:00')}}</td>
                        <td class="text-center">{{$input1[$i]->inlet_steam}}</td>
                        <td class="text-center">{{$input1[$i]->exm_steam}}</td>
                        <td class="text-center">{{$input1[$i]->turbin_thrust_bearing}}</td>
                        <td class="text-center">{{$input1[$i]->tb_gov_side}}</td>
                        <td class="text-center">{{$input1[$i]->tb_coup_side}}</td>
                        <td class="text-center">{{$input1[$i]->pb_tbn_side}}</td>
                        <td class="text-center">{{$input1[$i]->pb_gen_side}}</td>
                        <td class="text-center">{{$input1[$i]->wb_tbn_side}}</td>
                        <td class="text-center">{{$input1[$i]->wb_gen_side}}</td>
                        <td class="text-center">{{$input1[$i]->oc_lub_oil_outlet}}</td>
                        @endif
                        @if(isset($input2[$i]))
                        <td class="text-center">{{$input2[$i]->turbin_speed}}</td>
                        <td class="text-center">{{$input2[$i]->rotor_vib_monitor}}</td>
                        <td class="text-center">{{$input2[$i]->axial_displacement_monitor}}</td>
                        <td class="text-center">{{$input2[$i]->main_steam}}</td>
                        <td class="text-center">{{$input2[$i]->stage_steam}}</td>
                        <td class="text-center">{{$input2[$i]->exhaust}}</td>
                        <td class="text-center">{{$input2[$i]->lub_oil}}</td>
                        <td class="text-center">{{$input2[$i]->control_oil}}</td>
                        @endif
                        @if(isset($input3[$i]))
                        <td class="text-center">{{$input3[$i]->temp_water_in}}</td>
                        <td class="text-center">{{$input3[$i]->temp_water_out}}</td>
                        <td class="text-center">{{$input3[$i]->temp_oil_in}}</td>
                        <td class="text-center">{{$input3[$i]->temp_oil_out}}</td>
                        <td class="text-center">{{$input3[$i]->vacum}}</td>
                        <td class="text-center">{{$input3[$i]->injector}}</td>
                        <td class="text-center">{{$input3[$i]->speed_drop}}</td>
                        <td class="text-center">{{$input3[$i]->load_limit}}</td>
                        <td class="text-center">{{$input3[$i]->flo_in}}</td>
                        <td class="text-center">{{$input3[$i]->flo_out}}</td>
                        @endif
                        </tr>
                        @endfor
                        <!-- Baris rata-rata -->
                        <tr>
                            <td><strong>Rata-rata Keseluruhan</strong></td>
                            <td class="text-center">{{ count($input1) > 0 ? number_format($columns['inlet_steam'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input1) > 0 ? number_format($columns['exm_steam'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input1) > 0 ? number_format($columns['turbin_thrust_bearing'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input1) > 0 ? number_format($columns['tb_gov_side'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input1) > 0 ? number_format($columns['tb_coup_side'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input1) > 0 ? number_format($columns['pb_tbn_side'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input1) > 0 ? number_format($columns['pb_gen_side'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input1) > 0 ? number_format($columns['wb_tbn_side'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input1) > 0 ? number_format($columns['wb_gen_side'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input1) > 0 ? number_format($columns['oc_lub_oil_outlet'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input2) > 0 ? number_format($columns['turbin_speed'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input2) > 0 ? number_format($columns['rotor_vib_monitor'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input2) > 0 ? number_format($columns['axial_displacement_monitor'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input2) > 0 ? number_format($columns['main_steam'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input2) > 0 ? number_format($columns['stage_steam'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input2) > 0 ? number_format($columns['exhaust'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input2) > 0 ? number_format($columns['lub_oil'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input2) > 0 ? number_format($columns['control_oil'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input3) > 0 ? number_format($columns['temp_water_in'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input3) > 0 ? number_format($columns['temp_water_out'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input3) > 0 ? number_format($columns['temp_oil_in'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input3) > 0 ? number_format($columns['temp_oil_out'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input3) > 0 ? number_format($columns['vacum'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input3) > 0 ? number_format($columns['injector'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input3) > 0 ? number_format($columns['speed_drop'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input3) > 0 ? number_format($columns['load_limit'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input3) > 0 ? number_format($columns['flo_in'], 2) : 0 }}</td>
                            <td class="text-center">{{ count($input3) > 0 ? number_format($columns['flo_out'], 2) : 0 }}</td>
                        </tr>
            </table>
        </div>
    </div>
</body>

</html>