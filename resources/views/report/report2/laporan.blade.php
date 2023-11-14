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
                    <th class="text-center column-header">Turbin Speed</th>
                    <th class="text-center column-header">Rotor Vib Monitor</th>
                    <th class="text-center column-header">Axial Dis Monitor</th>
                    <th class="text-center column-header">Main Steam</th>
                    <th class="text-center column-header">Stage Steam</th>
                    <th class="text-center column-header">Exhaust</th>
                    <th class="text-center column-header">Lub Oil</th>
                    <th class="text-center column-header">Control Oil</th>
                </tr>
                <tr>
                    <th class="text-center column-header">(RPM)</th>
                    <th class="text-center column-header">(mm)</th>
                    <th class="text-center column-header">(mm)</th>
                    <th class="text-center column-header">(Kg/Cm&sup2;G)</th>
                    <th class="text-center column-header">(Kg/Cm&sup2;G)</th>
                    <th class="text-center column-header">(Kg/Cm&sup2;G)</th>
                    <th class="text-center column-header">(Kg/Cm&sup2;G)</th>
                    <th class="text-center column-header">(Kg/Cm&sup2;G)</th>
                </tr>
                <tr>
                    <th class="text-center column-header">Batas</th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header">0.08</th>
                    <th class="text-center column-header">+0.5/-0.9</th>
                    <th class="text-center column-header">45</th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header">1.7</th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                </tr>
                @php
                $groupSize = 8;
                $groupData = [];
                $groupCount = 0;

                $totalTurbinSpeed = 0;
                $totalRotorVibMonitor = 0;
                $totalAxialDisplacementMonitor = 0;
                $totalMainSteam = 0;
                $totalStageSteam = 0;
                $totalExhaust = 0;
                $totalLubOil = 0;
                $totalControlOil = 0;
                @endphp

                @foreach ($report2 as $key => $data)
                @php
                $groupData[] = $data;
                if (count($groupData) == $groupSize || $key == (count($report2) - 1)) {
                $groupCount++;
                $averageTurbinSpeed = 0;
                $averageRotorVibMonitor = 0;
                $averageAxialDisplacementMonitor = 0;
                $averageMainSteam = 0;
                $averageStageSteam = 0;
                $averageExhaust = 0;
                $averageLubOil = 0;
                $averageControlOil = 0;
                @endphp

                @foreach ($groupData as $groupDataItem)
                @php
                $averageTurbinSpeed += $groupDataItem->turbin_speed;
                $averageRotorVibMonitor += $groupDataItem->rotor_vib_monitor;
                $averageAxialDisplacementMonitor += $groupDataItem->axial_displacement_monitor;
                $averageMainSteam += $groupDataItem->main_steam;
                $averageStageSteam += $groupDataItem->stage_steam;
                $averageExhaust += $groupDataItem->exhaust;
                $averageLubOil += $groupDataItem->lub_oil;
                $averageControlOil += $groupDataItem->control_oil;

                // Tambahkan ke total keseluruhan
                $totalTurbinSpeed += $groupDataItem->turbin_speed;
                $totalRotorVibMonitor += $groupDataItem->rotor_vib_monitor;
                $totalAxialDisplacementMonitor += $groupDataItem->axial_displacement_monitor;
                $totalMainSteam += $groupDataItem->main_steam;
                $totalStageSteam += $groupDataItem->stage_steam;
                $totalExhaust += $groupDataItem->exhaust;
                $totalLubOil += $groupDataItem->lub_oil;
                $totalControlOil += $groupDataItem->control_oil;
                @endphp
                @endforeach

                @if (count($groupData) > 0)
                @php
                $averageTurbinSpeed /= count($groupData);
                $averageRotorVibMonitor /= count($groupData);
                $averageAxialDisplacementMonitor /= count($groupData);
                $averageMainSteam /= count($groupData);
                $averageStageSteam /= count($groupData);
                $averageExhaust /= count($groupData);
                $averageLubOil /= count($groupData);
                $averageControlOil /= count($groupData);
                @endphp
                @endif

                @foreach ($groupData as $groupDataItem)
                <tr>
                    <td>{{$groupDataItem->created_at->modify('+1 hour')->format('H:00')}}</td>
                    <td>{{ $groupDataItem->turbin_speed }}</td>
                    <td>{{ $groupDataItem->rotor_vib_monitor }}</td>
                    <td>{{ $groupDataItem->axial_displacement_monitor }}</td>
                    <td>{{ $groupDataItem->main_steam }}</td>
                    <td>{{ $groupDataItem->stage_steam }}</td>
                    <td>{{ $groupDataItem->exhaust }}</td>
                    <td>{{ $groupDataItem->lub_oil }}</td>
                    <td>{{ $groupDataItem->control_oil }}</td>
                </tr>
                @endforeach

                <!-- Tambahkan baris rata-rata setelah setiap kelompok -->
                <tr>
                    <td colspan="1"><strong>Rata-rata</strong></td>
                    <td>{{ number_format($averageTurbinSpeed, 2) }}</td>
                    <td>{{ number_format($averageRotorVibMonitor, 2) }}</td>
                    <td>{{ number_format($averageAxialDisplacementMonitor, 2) }}</td>
                    <td>{{ number_format($averageMainSteam, 2) }}</td>
                    <td>{{ number_format($averageStageSteam, 2) }}</td>
                    <td>{{ number_format($averageExhaust, 2) }}</td>
                    <td>{{ number_format($averageLubOil, 2) }}</td>
                    <td>{{ number_format($averageControlOil, 2) }}</td>
                </tr>

                @php
                // Bersihkan grup data setelah menghitung rata-rata
                $groupData = [];
                }
                @endphp
                @endforeach

                <!-- Baris rata-rata keseluruhan -->
                <tr>
                    <td colspan="1"><strong>Rata-rata Keseluruhan</strong></td>
                    <td>{{ count($report2) > 0 ? number_format($totalTurbinSpeed / count($report2), 2) : 0 }}</td>
                    <td>{{ count($report2) > 0 ? number_format($totalRotorVibMonitor / count($report2), 2) : 0 }}</td>
                    <td>{{ count($report2) > 0 ? number_format($totalAxialDisplacementMonitor / count($report2), 2) : 0 }}</td>
                    <td>{{ count($report2) > 0 ? number_format($totalMainSteam / count($report2), 2) : 0 }}</td>
                    <td>{{ count($report2) > 0 ? number_format($totalStageSteam / count($report2), 2) : 0 }}</td>
                    <td>{{ count($report2) > 0 ? number_format($totalExhaust / count($report2), 2) : 0 }}</td>
                    <td>{{ count($report2) > 0 ? number_format($totalLubOil / count($report2), 2) : 0 }}</td>
                    <td>{{ count($report2) > 0 ? number_format($totalControlOil / count($report2), 2) : 0 }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>