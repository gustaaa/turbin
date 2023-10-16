@extends('layouts.app')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1>Input2 List</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title" data-id="titleInput2Management">Menu Management</h2>

        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 data-id="input2ListData">Menu Input 2
                            <br>
                            <span style="font-size: 13px;">Tanggal: {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}</span>
                        </h4>
                        <div class="card-header-action">
                            <a class="btn btn-info btn-primary active" href="{{ url('/laporan/input2') }}?selected_date={{ $selectedDate ?? now()->format('Y-m-d') }}">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                Download Laporan
                            </a>
                            <a class="btn btn-info btn-primary active" href="{{ url('export/input2') }}?selected_date={{ $selectedDate ?? now()->format('Y-m-d') }}">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                Export Input 2</a>
                            <a class="btn btn-info btn-primary active search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Search Input</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="show-search mb-3" style="display: none">
                            <form id="search" method="GET" action="{{ route('report2.index') }}">
                                <div class="form-group">
                                    <label for="selected_date">Pilih Tanggal:</label>
                                    <input type="date" class="form-control" id="selected_date" name="selected_date" value="{{ $selectedDate ?? now()->format('Y-m-d') }}">
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <a class="btn btn-secondary" href="{{ route('report2.index') }}">Reset</a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Created At</th>
                                        <th data-id="thTurbinSpeed">Turbin Speed</th>
                                        <th data-id="thRotorVibMonitor">Rotor Vib Monitor</th>
                                        <th data-id="thAxialDisMonitor">Axial Dis Monitor</th>
                                        <th data-id="thMainSteam">Main Steam</th>
                                        <th data-id="thStageSteam">Stage Steam</th>
                                        <th data-id="thExhaust">Exhaust</th>
                                        <th data-id="thLubOil">Lub Oil</th>
                                        <th data-id="thControlOil">Control Oil</th>
                                        <th class="text-center">Action</th>
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
                                        <td>{{ ($loop->index + 1) + (($groupCount - 1) * $groupSize) }}</td>
                                        <td>{{$groupDataItem->created_at->modify('+1 hour')->format('H:00')}}</td>
                                        <td>{{ $groupDataItem->turbin_speed }}</td>
                                        <td>{{ $groupDataItem->rotor_vib_monitor }}</td>
                                        <td>{{ $groupDataItem->axial_displacement_monitor }}</td>
                                        <td>{{ $groupDataItem->main_steam }}</td>
                                        <td>{{ $groupDataItem->stage_steam }}</td>
                                        <td>{{ $groupDataItem->exhaust }}</td>
                                        <td>{{ $groupDataItem->lub_oil }}</td>
                                        <td>{{ $groupDataItem->control_oil }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('report2.edit', $groupDataItem->id) }}" data-id="editInput131" class="btn btn-sm btn-info btn-icon mr-2">
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
                                        <td>{{ number_format($averageTurbinSpeed, 2) }}</td>
                                        <td>{{ number_format($averageRotorVibMonitor, 2) }}</td>
                                        <td>{{ number_format($averageAxialDisplacementMonitor, 2) }}</td>
                                        <td>{{ number_format($averageMainSteam, 2) }}</td>
                                        <td>{{ number_format($averageStageSteam, 2) }}</td>
                                        <td>{{ number_format($averageExhaust, 2) }}</td>
                                        <td>{{ number_format($averageLubOil, 2) }}</td>
                                        <td>{{ number_format($averageControlOil, 2) }}</td>
                                        <td></td> <!-- Kolom lainnya -->
                                    </tr>

                                    @php
                                    // Bersihkan grup data setelah menghitung rata-rata
                                    $groupData = [];
                                    }
                                    @endphp
                                    @endforeach

                                    <!-- Baris rata-rata keseluruhan -->
                                    <tr>
                                        <td colspan="2"><strong>Rata-rata Keseluruhan</strong></td>
                                        <td>{{ count($report2) > 0 ? number_format($totalTurbinSpeed / count($report2), 2) : 0 }}</td>
                                        <td>{{ count($report2) > 0 ? number_format($totalRotorVibMonitor / count($report2), 2) : 0 }}</td>
                                        <td>{{ count($report2) > 0 ? number_format($totalAxialDisplacementMonitor / count($report2), 2) : 0 }}</td>
                                        <td>{{ count($report2) > 0 ? number_format($totalMainSteam / count($report2), 2) : 0 }}</td>
                                        <td>{{ count($report2) > 0 ? number_format($totalStageSteam / count($report2), 2) : 0 }}</td>
                                        <td>{{ count($report2) > 0 ? number_format($totalExhaust / count($report2), 2) : 0 }}</td>
                                        <td>{{ count($report2) > 0 ? number_format($totalLubOil / count($report2), 2) : 0 }}</td>
                                        <td>{{ count($report2) > 0 ? number_format($totalControlOil / count($report2), 2) : 0 }}</td>
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