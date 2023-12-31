@extends('layouts.app')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1>Input3 List</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title" data-id="titleInput3Management">Menu Management</h2>

        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 data-id="input3ListData">Menu Input 3
                            <br>
                            <span style="font-size: 13px;">Tanggal: {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}</span>
                        </h4>
                        <div class="card-header-action">
                            <div class="card-header-action">
                                <a class="btn btn-info btn-primary active" href="{{ url('/laporan/input3') }}?selected_date={{ $selectedDate ?? now()->format('Y-m-d') }}">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Download Laporan
                                </a>
                                <a class="btn btn-info btn-primary active" href="{{ url('export/input3') }}?selected_date={{ $selectedDate ?? now()->format('Y-m-d') }}">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Export Input 3</a>
                                <a class="btn btn-info btn-primary active search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Input</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="show-search mb-3" style="display: none">
                            <form id="search" method="GET" action="{{ route('report3.index') }}">
                                <div class="form-group">
                                    <label for="selected_date">Pilih Tanggal:</label>
                                    <input type="date" class="form-control" id="selected_date" name="selected_date" value="{{ $selectedDate ?? now()->format('Y-m-d') }}">
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <a class="btn btn-secondary" href="{{ route('report3.index') }}">Reset</a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Batas</th>
                                        <th data-id="thTempWaterIn">Temp Water In</th>
                                        <th data-id="thTempWaterOut">Temp Water Out</th>
                                        <th data-id="thTempOilIn">Temp Oil In</th>
                                        <th data-id="thTempOilOut">Temp Oil Out</th>
                                        <th data-id="thVacum">Vacum</th>
                                        <th data-id="thInjector">Injector</th>
                                        <th data-id="thSpeedDrop">Speed Drop</th>
                                        <th data-id="thLoadLimit">Load Limit</th>
                                        <th data-id="thFLOIn">FLO In</th>
                                        <th data-id="thFLOOut">FLO Out</th>
                                        <th class="text-center">Action</th>
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
                                        <td>{{ ($loop->index + 1) + (($groupCount - 1) * $groupSize) }}</td>
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

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('report3.edit', $groupDataItem->id) }}" data-id="editInput131" class="btn btn-sm btn-info btn-icon mr-2">
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
                                        <td>{{ number_format($averageTempWaterIn, 2) }}</td>
                                        <td>{{ number_format($averageTempWaterOut, 2) }}</td>
                                        <td>{{ number_format($averageTempOilIn, 2) }}</td>
                                        <td>{{ number_format($averageTempOilOut, 2) }}</td>
                                        <td>{{ number_format($averageVacum, 2) }}</td>
                                        <td>{{ number_format($averageInjector, 2) }}</td>
                                        <td>{{ number_format($averageSpeedDrop, 2) }}</td>
                                        <td>{{ number_format($averageLoadLimit, 2) }}</td>
                                        <td>{{ number_format($averageFloIn, 2) }}</td>
                                        <td>{{ number_format($averageFloOut, 2) }}</td>
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
                                        <td>{{ count($report3) > 0 ? number_format($totalTempWaterIn / count($report3), 2) : 0 }}</td>
                                        <td>{{ count($report3) > 0 ? number_format($totalTempWaterOut / count($report3), 2) : 0 }}</td>
                                        <td>{{ count($report3) > 0 ? number_format($totalTempOilIn / count($report3), 2) : 0 }}</td>
                                        <td>{{ count($report3) > 0 ? number_format($totalTempOilOut / count($report3), 2) : 0 }}</td>
                                        <td>{{ count($report3) > 0 ? number_format($totalVacum / count($report3), 2) : 0 }}</td>
                                        <td>{{ count($report3) > 0 ? number_format($totalInjector / count($report3), 2) : 0 }}</td>
                                        <td>{{ count($report3) > 0 ? number_format($totalSpeedDrop / count($report3), 2) : 0 }}</td>
                                        <td>{{ count($report3) > 0 ? number_format($totalLoadLimit / count($report3), 2) : 0 }}</td>
                                        <td>{{ count($report3) > 0 ? number_format($totalFloIn / count($report3), 2) : 0 }}</td>
                                        <td>{{ count($report3) > 0 ? number_format($totalFloOut / count($report3), 2) : 0 }}</td>
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