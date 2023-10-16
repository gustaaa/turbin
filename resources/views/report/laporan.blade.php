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
                    <th>Batas</th>
                    <th>Inlet Steam</th>
                    <th>Exm Steam</th>
                    <th>Turbin thrust bearing</th>
                    <th>TB Gov Side</th>
                    <th>TB Coup Side</th>
                    <th>PB tbn side</th>
                    <th>PB gen side</th>
                    <th>WB tbn side</th>
                    <th>WB gen side</th>
                    <th>OC lub oil outlet</th>
                    <th>Turbin Speed</th>
                    <th>Rotor Vib Monitor</th>
                    <th>Axial Dis Monitor</th>
                    <th>Main Steam</th>
                    <th>Stage Steam</th>
                    <th>Exhaust</th>
                    <th>Lub Oil</th>
                    <th>Control Oil</th>
                    <th>Temp Water In</th>
                    <th>Temp Water Out</th>
                    <th>Temp Oil In</th>
                    <th>Temp Oil Out</th>
                    <th>Vacum</th>
                    <th>Injector</th>
                    <th>Speed Drop</th>
                    <th>Load Limit</th>
                    <th>FLO In</th>
                    <th>FLO Out</th>
                </tr>

                @php
                $totalData = max(count($input1), count($input2), count($input3));
                @endphp
                @for($i = 0; $i < $totalData; $i++) <tr>
                    @if(isset($input1[$i]))
                    <td>{{$input1[$i]->created_at->modify('+1 hour')->format('H:00')}}</td>
                    <td>{{$input1[$i]->inlet_steam}}</td>
                    <td>{{$input1[$i]->exm_steam}}</td>
                    <td>{{$input1[$i]->turbin_thrust_bearing}}</td>
                    <td>{{$input1[$i]->tb_gov_side}}</td>
                    <td>{{$input1[$i]->tb_coup_side}}</td>
                    <td>{{$input1[$i]->pb_tbn_side}}</td>
                    <td>{{$input1[$i]->pb_gen_side}}</td>
                    <td>{{$input1[$i]->wb_tbn_side}}</td>
                    <td>{{$input1[$i]->wb_gen_side}}</td>
                    <td>{{$input1[$i]->oc_lub_oil_outlet}}</td>
                    @endif
                    @if(isset($input2[$i]))
                    <td>{{$input2[$i]->turbin_speed}}</td>
                    <td>{{$input2[$i]->rotor_vib_monitor}}</td>
                    <td>{{$input2[$i]->axial_displacement_monitor}}</td>
                    <td>{{$input2[$i]->main_steam}}</td>
                    <td>{{$input2[$i]->stage_steam}}</td>
                    <td>{{$input2[$i]->exhaust}}</td>
                    <td>{{$input2[$i]->lub_oil}}</td>
                    <td>{{$input2[$i]->control_oil}}</td>
                    @endif
                    @if(isset($input3[$i]))
                    <td>{{$input3[$i]->temp_water_in}}</td>
                    <td>{{$input3[$i]->temp_water_out}}</td>
                    <td>{{$input3[$i]->temp_oil_in}}</td>
                    <td>{{$input3[$i]->temp_oil_out}}</td>
                    <td>{{$input3[$i]->vacum}}</td>
                    <td>{{$input3[$i]->injector}}</td>
                    <td>{{$input3[$i]->speed_drop}}</td>
                    <td>{{$input3[$i]->load_limit}}</td>
                    <td>{{$input3[$i]->flo_in}}</td>
                    <td>{{$input3[$i]->flo_out}}</td>
                    @endif
                    </tr>
                    @endfor

            </table>
        </div>
    </div>
</body>

</html>