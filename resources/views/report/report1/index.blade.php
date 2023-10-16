@extends('layouts.app')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1>Input 1 List Report</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title" data-id="titleInput1Management">Menu Management</h2>

        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 data-id="input1ListData" style="text-align: center;">
                            Menu Input 1
                            <br>
                            <span style="font-size: 13px;">Tanggal: {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}</span>
                        </h4>
                        <div class="card-header-action">
                            <a class="btn btn-info btn-primary active" href="{{ url('/laporan/input1') }}?selected_date={{ $selectedDate ?? now()->format('Y-m-d') }}">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                Download Laporan
                            </a>
                            <a class="btn btn-info btn-primary active" href="{{ url('export/input1') }}?selected_date={{ $selectedDate ?? now()->format('Y-m-d') }}">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                Export Input 1
                            </a>
                            <a class="btn btn-info btn-primary active search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Search Input
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="show-search mb-3" style="display: none">
                            <form id="search" method="GET" action="{{ route('report1.index') }}">
                                <div class="form-group">
                                    <label for="selected_date">Pilih Tanggal:</label>
                                    <input type="date" class="form-control" id="selected_date" name="selected_date" value="{{ $selectedDate ?? now()->format('Y-m-d') }}">
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <a class="btn btn-secondary" href="{{ route('report1.index') }}">Reset</a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Created At</th>
                                        <th data-id="thInletSteam">Inlet Steam</th>
                                        <th data-id="thExmSteam">Exm Steam</th>
                                        <th data-id="thTTB">Turbin thrust bearing</th>
                                        <th data-id="thTBGovSide">TB Gov Side</th>
                                        <th data-id="thTBCoupSide">TB Coup Side</th>
                                        <th data-id="thPBTbnSide">PB tbn side</th>
                                        <th data-id="thPBGenSide">PB gen side</th>
                                        <th data-id="thWBTbnSide">WB tbn side</th>
                                        <th data-id="thWBGenSide">WB gen side</th>
                                        <th data-id="thOCLubOilOutlet">OC lub oil outlet</th>
                                        <th class="text-center">Action</th>
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
                                        <td>{{ ($loop->index + 1) + (($groupCount - 1) * $groupSize) }}</td>
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
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('report1.edit', $groupDataItem->id) }}" data-id="editInput131" class="btn btn-sm btn-info btn-icon mr-2">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                    <!-- Tambahkan baris rata-rata setelah setiap kelompok -->
                                    <tr>
                                        <td colspan="2"><strong>Rata-rata</strong></td>
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
                                        <td colspan="2"><strong>Rata-rata Keseluruhan</strong></td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('customScript')
<script>
    $(document).ready(function() {
        $('.search').click(function(event) {
            event.stopPropagation();
            $(".show-search").slideToggle("fast");
            $(".show-import").hide();
        });
    });
</script>
@endpush

@push('customStyle')
@endpush