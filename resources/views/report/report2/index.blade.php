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

                                    </tr>
                                    @foreach($report2 as $key => $data)
                                    <tr>
                                        <td>{{ ($report2->currentPage() - 1) * $report2->perPage() + $loop->iteration }}</td>
                                        <td>{{$data->created_at}}</td>
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
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $report2->withQueryString()->links() }}
                            </div>
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