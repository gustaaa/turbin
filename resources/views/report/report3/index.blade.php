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
                                        <th>#</th>
                                        <th>Created At</th>
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
                                    @foreach($report3 as $key => $data)
                                    <tr>
                                        <td>{{ ($report3->currentPage() - 1) * $report3->perPage() + $loop->iteration }}</td>
                                        <td>{{$data->created_at}}</td>
                                        <td>{{$data->temp_water_in}}</td>
                                        <td>{{$data->temp_water_out}}</td>
                                        <td>{{$data->temp_oil_in}}</td>
                                        <td>{{$data->temp_oil_out}}</td>
                                        <td>{{$data->vacum}}</td>
                                        <td>{{$data->injector}}</td>
                                        <td>{{$data->speed_drop}}</td>
                                        <td>{{$data->load_limit}}</td>
                                        <td>{{$data->flo_in}}</td>
                                        <td>{{$data->flo_out}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $report3->withQueryString()->links() }}
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