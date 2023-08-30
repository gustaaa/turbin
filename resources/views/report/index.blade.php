@extends('layouts.app')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1>Input1 List</h1>
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
                        <h4 data-id="input1ListData">Menu Report All
                            <br>
                            <span style="font-size: 13px;">Tanggal: {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}</span>
                        </h4>
                        <div class="card-header-action">
                            <a class="btn btn-info btn-primary active" href="{{ url('/laporan/report-all') }}?selected_date={{ $selectedDate ?? now()->format('Y-m-d') }}">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                Download Laporan
                            </a>
                            <a class="btn btn-info btn-primary active" href="{{ url('export/report-all') }}?selected_date={{ $selectedDate ?? now()->format('Y-m-d') }}">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                Export All Report</a>
                            <a class="btn btn-info btn-primary active search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Search Input</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="show-search mb-3" style="display: none">
                            <form id="search" method="GET" action="{{ route('report.index') }}">
                                <div class="form-group">
                                    <label for="selected_date">Pilih Tanggal:</label>
                                    <input type="date" class="form-control" id="selected_date" name="selected_date" value="{{ $selectedDate ?? now()->format('Y-m-d') }}">
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <a class="btn btn-secondary" href="{{ route('report.index') }}">Reset</a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    <tr>
                                        <th>Batas</th>
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
                                        <th data-id="thTurbinSpeed">Turbin Speed</th>
                                        <th data-id="thRotorVibMonitor">Rotor Vib Monitor</th>
                                        <th data-id="thAxialDisMonitor">Axial Dis Monitor</th>
                                        <th data-id="thMainSteam">Main Steam</th>
                                        <th data-id="thStageSteam">Stage Steam</th>
                                        <th data-id="thExhaust">Exhaust</th>
                                        <th data-id="thLubOil">Lub Oil</th>
                                        <th data-id="thControlOil">Control Oil</th>
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
                                    </tr>
                                    @php
                                    $totalData = max(count($input1), count($input2), count($input3));
                                    @endphp
                                    @for($i = 0; $i < $totalData; $i++) <tr>
                                        @if(isset($input1[$i]))
                                        <td>{{$input1[$i]->created_at->format('H:00')}}</td>
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