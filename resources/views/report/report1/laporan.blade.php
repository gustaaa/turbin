<!DOCTYPE html>
<lang html>

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
                    </tr>
                    <tr>
                        <th class="text-center column-header">Batas</th>
                        <th class="text-center column-header">450</th>
                        <th class="text-center column-header"></th>
                        <th class="text-center column-header">70</th>
                        <th class="text-center column-header">70</th>
                        <th class="text-center column-header">70</th>
                        <th class="text-center column-header">70</th>
                        <th class="text-center column-header">70</th>
                        <th class="text-center column-header">70</th>
                        <th class="text-center column-header">70</th>
                        <th class="text-center column-header">50</th>
                    </tr>
                    @php
                    $groupSize = 8;
                    $groupData = [];
                    $groupCount = 0;

                    $totalInletSteam = 0;
                    $totalExmSteam = 0;
                    $totalTurbinThrustBearing = 0;
                    $totalTBGovSide = 0;
                    $totalTBCoupSide = 0;
                    $totalPBTbnSide = 0;
                    $totalPBGenSide = 0;
                    $totalWBTbnSide = 0;
                    $totalWBGenSide = 0;
                    $totalOCLubOilOutlet = 0;

                    foreach ($report1 as $key => $data) {
                    $groupData[] = $data;
                    if (count($groupData) == $groupSize || $key == (count($report1) - 1)) {
                    $groupCount++;
                    $averageInletSteam = 0;
                    $averageExmSteam = 0;
                    $averageTurbinThrustBearing = 0;
                    $averageTBGovSide = 0;
                    $averageTBCoupSide = 0;
                    $averagePBTbnSide = 0;
                    $averagePBGenSide = 0;
                    $averageWBTbnSide = 0;
                    $averageWBGenSide = 0;
                    $averageOCLubOilOutlet = 0;

                    foreach ($groupData as $groupDataItem) {
                    $averageInletSteam += $groupDataItem->inlet_steam;
                    $averageExmSteam += $groupDataItem->exm_steam;
                    $averageTurbinThrustBearing += $groupDataItem->turbin_thrust_bearing;
                    $averageTBGovSide += $groupDataItem->tb_gov_side;
                    $averageTBCoupSide += $groupDataItem->tb_coup_side;
                    $averagePBTbnSide += $groupDataItem->pb_tbn_side;
                    $averagePBGenSide += $groupDataItem->pb_gen_side;
                    $averageWBTbnSide += $groupDataItem->wb_tbn_side;
                    $averageWBGenSide += $groupDataItem->wb_gen_side;
                    $averageOCLubOilOutlet += $groupDataItem->oc_lub_oil_outlet;

                    // Tambahkan ke total keseluruhan
                    $totalInletSteam += $groupDataItem->inlet_steam;
                    $totalExmSteam += $groupDataItem->exm_steam;
                    $totalTurbinThrustBearing += $groupDataItem->turbin_thrust_bearing;
                    $totalTBGovSide += $groupDataItem->tb_gov_side;
                    $totalTBCoupSide += $groupDataItem->tb_coup_side;
                    $totalPBTbnSide += $groupDataItem->pb_tbn_side;
                    $totalPBGenSide += $groupDataItem->pb_gen_side;
                    $totalWBTbnSide += $groupDataItem->wb_tbn_side;
                    $totalWBGenSide += $groupDataItem->wb_gen_side;
                    $totalOCLubOilOutlet += $groupDataItem->oc_lub_oil_outlet;

                    }

                    if (count($groupData) > 0) {
                    $averageInletSteam /= count($groupData);
                    $averageExmSteam /= count($groupData);
                    $averageTurbinThrustBearing /= count($groupData);
                    $averageTBGovSide /= count($groupData);
                    $averageTBCoupSide /= count($groupData);
                    $averagePBTbnSide /= count($groupData);
                    $averagePBGenSide /= count($groupData);
                    $averageWBTbnSide /= count($groupData);
                    $averageWBGenSide /= count($groupData);
                    $averageOCLubOilOutlet /= count($groupData);
                    }
                    @endphp
                    @foreach ($groupData as $groupDataItem)
                    <tr>
                        <td>{{$groupDataItem->created_at->modify('+1 hour')->format('H:00')}}</td>
                        <td>{{ $groupDataItem->inlet_steam }}</td>
                        <td>{{ $groupDataItem->exm_steam }}</td>
                        <td>{{ $groupDataItem->turbin_thrust_bearing }}</td>
                        <td>{{ $groupDataItem->tb_gov_side }}</td>
                        <td>{{ $groupDataItem->tb_coup_side }}</td>
                        <td>{{ $groupDataItem->pb_tbn_side }}</td>
                        <td>{{ $groupDataItem->pb_gen_side }}</td>
                        <td>{{ $groupDataItem->wb_tbn_side }}</td>
                        <td>{{ $groupDataItem->wb_gen_side }}</td>
                        <td>{{ $groupDataItem->oc_lub_oil_outlet }}</td>
                    </tr>
                    @endforeach
                    <!-- Tambahkan baris rata-rata setelah setiap kelompok -->
                    <tr>
                        <td colspan="1"><strong>Rata-rata</strong></td>
                        <td>{{ number_format($averageInletSteam, 2) }}</td>
                        <td>{{ number_format($averageExmSteam, 2) }}</td>
                        <td>{{ number_format($averageTurbinThrustBearing, 2) }}</td>
                        <td>{{ number_format($averageTBGovSide, 2) }}</td>
                        <td>{{ number_format($averageTBCoupSide, 2) }}</td>
                        <td>{{ number_format($averagePBTbnSide, 2) }}</td>
                        <td>{{ number_format($averagePBGenSide, 2) }}</td>
                        <td>{{ number_format($averageWBTbnSide, 2) }}</td>
                        <td>{{ number_format($averageWBGenSide, 2) }}</td>
                        <td>{{ number_format($averageOCLubOilOutlet, 2) }}</td>
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
                        <td>{{ count($report1) > 0 ? number_format($totalInletSteam / count($report1), 2) : 0 }}</td>
                        <td>{{ count($report1) > 0 ? number_format($totalExmSteam / count($report1), 2) : 0 }}</td>
                        <td>{{ count($report1) > 0 ? number_format($totalTurbinThrustBearing / count($report1), 2) : 0 }}</td>
                        <td>{{ count($report1) > 0 ? number_format($totalTBGovSide / count($report1), 2) : 0 }}</td>
                        <td>{{ count($report1) > 0 ? number_format($totalTBCoupSide / count($report1), 2) : 0 }}</td>
                        <td>{{ count($report1) > 0 ? number_format($totalPBTbnSide / count($report1), 2) : 0 }}</td>
                        <td>{{ count($report1) > 0 ? number_format($totalPBGenSide / count($report1), 2) : 0 }}</td>
                        <td>{{ count($report1) > 0 ? number_format($totalWBTbnSide / count($report1), 2) : 0 }}</td>
                        <td>{{ count($report1) > 0 ? number_format($totalWBGenSide / count($report1), 2) : 0 }}</td>
                        <td>{{ count($report1) > 0 ? number_format($totalOCLubOilOutlet / count($report1), 2) : 0 }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </body>

    </html>