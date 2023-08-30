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
            /* Contoh CSS tambahan untuk tampilan dalam orientasi landscape */

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

                    <th>Created At</th>
                    <th>Turbin Speed</th>
                    <th>Rotor Vib Monitor</th>
                    <th>Axial Dis Monitor</th>
                    <th>Main Steam</th>
                    <th>Stage Steam</th>
                    <th>Exhaust</th>
                    <th>Lub Oil</th>
                    <th>Control Oil</th>

                </tr>
                @foreach($input2 as $key => $data)
                <tr>

                    <td>{{$data->created_at->format('H:00')}}</td>
                    <td>{{$data->turbin_speed}}</td>
                    <td>{{$data->rotor_vib_monitor}}</td>
                    <td>{{$data->axial_displacement_monitor}}</td>
                    <td>{{$data->main_steam}}</td>
                    <td>{{$data->stage_steam}}</td>
                    <td>{{$data->exhaust}}</td>
                    <td>{{$data->lub_oil}}</td>
                    <td>{{$data->control_oil}}</td>

                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>