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
            size: landscape;
        }

        body {
            font-size: 10px;
            /* Atur ukuran font */
        }

        .table th,
        .table td {
            padding: 6px;
            /* Atur padding sel dalam tabel */
            font-size: 8px;
            /* Atur ukuran font sel dalam tabel */
        }

        /* Tambahkan properti CSS tambahan sesuai kebutuhan */
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-12 margin-tb">
            <div class="pull-left mt-2">
                <h5 align="center">LOGSHEET TURBIN A/B</h5>
                <h5 align="center">DEPARTEMEN ELEKTRIK 2023</h5>
                <h5 align="center">PG GLENMORE</h5>
            </div>
            <div class="pull-right">
                <h3 align="left" style="font-size: 10px;">Tanggal: {{ $selectedDate }}</h3>
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

                <tr>
                    @foreach($input1 as $key => $data1)
                    <td>{{ $data1->created_at->format('H:00')}}</td>
                    <td>{{$data1->inlet_steam}}</td>
                    <td>{{$data1->exm_steam}}</td>
                    <td>{{$data1->turbin_thrust_bearing}}</td>
                    <td>{{$data1->tb_gov_side}}</td>
                    <td>{{$data1->tb_coup_side}}</td>
                    <td>{{$data1->pb_tbn_side}}</td>
                    <td>{{$data1->pb_gen_side}}</td>
                    <td>{{$data1->wb_tbn_side}}</td>
                    <td>{{$data1->wb_gen_side}}</td>
                    <td>{{$data1->oc_lub_oil_outlet}}</td>
                    @endforeach
                    @foreach($input2 as $key => $data2)
                    <td>{{$data2->turbin_speed}}</td>
                    <td>{{$data2->rotor_vib_monitor}}</td>
                    <td>{{$data2->axial_displacement_monitor}}</td>
                    <td>{{$data2->main_steam}}</td>
                    <td>{{$data2->stage_steam}}</td>
                    <td>{{$data2->exhaust}}</td>
                    <td>{{$data2->lub_oil}}</td>
                    <td>{{$data2->control_oil}}</td>
                    @endforeach
                    @foreach($input3 as $key => $data3)
                    <td>{{$data3->temp_water_in}}</td>
                    <td>{{$data3->temp_water_out}}</td>
                    <td>{{$data3->temp_oil_in}}</td>
                    <td>{{$data3->temp_oil_out}}</td>
                    <td>{{$data3->vacum}}</td>
                    <td>{{$data3->injector}}</td>
                    <td>{{$data3->speed_drop}}</td>
                    <td>{{$data3->load_limit}}</td>
                    <td>{{$data3->flo_in}}</td>
                    <td>{{$data3->flo_out}}</td>
                    @endforeach
                </tr>

            </table>
        </div>
    </div>
</body>

</html>