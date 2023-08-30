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
                        <h4 data-id="input1ListData">Menu Input 1
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
                                Export Input 1</a>
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

                                    </tr>
                                    @foreach($report1 as $key => $data)
                                    <tr>
                                        <td>{{ ($report1->currentPage() - 1) * $report1->perPage() + $loop->iteration }}</td>
                                        <td>{{$data->created_at}}</td>
                                        <td>{{$data->inlet_steam}}</td>
                                        <td>{{$data->exm_steam}}</td>
                                        <td>{{$data->turbin_thrust_bearing}}</td>
                                        <td>{{$data->tb_gov_side}}</td>
                                        <td>{{$data->tb_coup_side}}</td>
                                        <td>{{$data->pb_tbn_side}}</td>
                                        <td>{{$data->pb_gen_side}}</td>
                                        <td>{{$data->wb_tbn_side}}</td>
                                        <td>{{$data->wb_gen_side}}</td>
                                        <td>{{$data->oc_lub_oil_outlet}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $report1->withQueryString()->links() }}
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