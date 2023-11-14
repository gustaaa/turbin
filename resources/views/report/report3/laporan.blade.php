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
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                    <th class="text-center column-header"></th>
                </tr>
                <tr>
                    <th class="text-center column-header">Batas</th>
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
                $groupSize = 8;
                $groupData = [];
                $groupCount = 0;

                $totalTempWaterIn = 0;
                $totalTempWaterOut = 0;
                $totalTempOilIn = 0;
                $totalTempOilOut = 0;
                $totalVacum = 0;
                $totalInjector = 0;
                $totalSpeedDrop = 0;
                $totalLoadLimit = 0;
                $totalFloIn = 0;
                $totalFloOut = 0;

                foreach ($report3 as $key => $data) {
                $groupData[] = $data;
                if (count($groupData) == $groupSize || $key == (count($report3) - 1)) {
                $groupCount++;
                $averageTempWaterIn = 0;
                $averageTempWaterOut = 0;
                $averageTempOilIn = 0;
                $averageTempOilOut = 0;
                $averageVacum = 0;
                $averageInjector = 0;
                $averageSpeedDrop = 0;
                $averageLoadLimit = 0;
                $averageFloIn = 0;
                $averageFloOut = 0;

                foreach ($groupData as $groupDataItem) {
                $averageTempWaterIn += $groupDataItem->temp_water_in;
                $averageTempWaterOut += $groupDataItem->temp_water_out;
                $averageTempOilIn += $groupDataItem->temp_oil_in;
                $averageTempOilOut += $groupDataItem->temp_oil_out;
                $averageVacum += $groupDataItem->vacum;
                $averageInjector += $groupDataItem->injector;
                $averageSpeedDrop += $groupDataItem->speed_drop;
                $averageLoadLimit += $groupDataItem->load_limit;
                $averageFloIn += $groupDataItem->flo_in;
                $averageFloOut += $groupDataItem->flo_out;

                // Tambahkan ke total keseluruhan
                $totalTempWaterIn += $groupDataItem->temp_water_in;
                $totalTempWaterOut += $groupDataItem->temp_water_out;
                $totalTempOilIn += $groupDataItem->temp_oil_in;
                $totalTempOilOut += $groupDataItem->temp_oil_out;
                $totalVacum += $groupDataItem->vacum;
                $totalInjector += $groupDataItem->injector;
                $totalSpeedDrop += $groupDataItem->speed_drop;
                $totalLoadLimit += $groupDataItem->load_limit;
                $totalFloIn += $groupDataItem->flo_in;
                $totalFloOut += $groupDataItem->flo_out;
                }

                if (count($groupData) > 0) {
                $averageTempWaterIn /= count($groupData);
                $averageTempWaterOut /= count($groupData);
                $averageTempOilIn /= count($groupData);
                $averageTempOilOut /= count($groupData);
                $averageVacum /= count($groupData);
                $averageInjector /= count($groupData);
                $averageSpeedDrop /= count($groupData);
                $averageLoadLimit /= count($groupData);
                $averageFloIn /= count($groupData);
                $averageFloOut /= count($groupData);
                }
                @endphp

                @foreach ($groupData as $groupDataItem)
                <tr>
                    <td>{{$groupDataItem->created_at->modify('+1 hour')->format('H:00')}}</td>
                    <td>{{ $groupDataItem->temp_water_in }}</td>
                    <td>{{ $groupDataItem->temp_water_out }}</td>
                    <td>{{ $groupDataItem->temp_oil_in }}</td>
                    <td>{{ $groupDataItem->temp_oil_out }}</td>
                    <td>{{ $groupDataItem->vacum }}</td>
                    <td>{{ $groupDataItem->injector }}</td>
                    <td>{{ $groupDataItem->speed_drop }}</td>
                    <td>{{ $groupDataItem->load_limit }}</td>
                    <td>{{ $groupDataItem->flo_in }}</td>
                    <td>{{ $groupDataItem->flo_out }}</td>
                    @endforeach

                    <!-- Tambahkan baris rata-rata setelah setiap kelompok -->
                <tr>
                    <td colspan="1"><strong>Rata-rata</strong></td>
                    <td>{{ number_format($averageTempWaterIn, 5) }}</td>
                    <td>{{ number_format($averageTempWaterOut, 5) }}</td>
                    <td>{{ number_format($averageTempOilIn, 5) }}</td>
                    <td>{{ number_format($averageTempOilOut, 5) }}</td>
                    <td>{{ number_format($averageVacum, 5) }}</td>
                    <td>{{ number_format($averageInjector, 5) }}</td>
                    <td>{{ number_format($averageSpeedDrop, 5) }}</td>
                    <td>{{ number_format($averageLoadLimit, 5) }}</td>
                    <td>{{ number_format($averageFloIn, 5) }}</td>
                    <td>{{ number_format($averageFloOut, 5) }}</td>
                </tr>

                @php
                // Bersihkan grup data setelah menghitung rata-rata
                $groupData = [];
                }
                }
                @endphp

                <!-- Baris rata-rata keseluruhan -->
                <tr>
                    <td colspan="1"><strong>Rata-rata Keseluruhan</strong></td>
                    <td>{{ count($report3) > 0 ? number_format($totalTempWaterIn / count($report3), 5) : 0 }}</td>
                    <td>{{ count($report3) > 0 ? number_format($totalTempWaterOut / count($report3), 5) : 0 }}</td>
                    <td>{{ count($report3) > 0 ? number_format($totalTempOilIn / count($report3), 5) : 0 }}</td>
                    <td>{{ count($report3) > 0 ? number_format($totalTempOilOut / count($report3), 5) : 0 }}</td>
                    <td>{{ count($report3) > 0 ? number_format($totalVacum / count($report3), 5) : 0 }}</td>
                    <td>{{ count($report3) > 0 ? number_format($totalInjector / count($report3), 5) : 0 }}</td>
                    <td>{{ count($report3) > 0 ? number_format($totalSpeedDrop / count($report3), 5) : 0 }}</td>
                    <td>{{ count($report3) > 0 ? number_format($totalLoadLimit / count($report3), 5) : 0 }}</td>
                    <td>{{ count($report3) > 0 ? number_format($totalFloIn / count($report3), 5) : 0 }}</td>
                    <td>{{ count($report3) > 0 ? number_format($totalFloOut / count($report3), 5) : 0 }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>