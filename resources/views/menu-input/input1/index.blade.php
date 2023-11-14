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
                            <a class="btn btn-icon icon-left btn-primary" data-id="input1Add" href="{{ route('input1.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Create New input1
                            </a>
                            <a class="btn btn-info btn-primary active search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Search Input
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="show-search mb-3" style="display: none">
                            <form id="search" method="GET" action="{{ route('input1.index') }}">
                                <div class="form-group">
                                    <label for="selected_date">Pilih Tanggal:</label>
                                    <input type="date" class="form-control" id="selected_date" name="selected_date" value="{{ $selectedDate ?? now()->format('Y-m-d') }}">
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <a class="btn btn-secondary" href="{{ route('input1.index') }}">Reset</a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    <tr>
                                        <th>No</th>
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
                                        <th class="text-center">Action</th>
                                    </tr>
                                    @foreach($input1 as $key => $data)
                                    <tr>
                                        <td>{{ ($loop->index + 1) }}</td>
                                        <td>{{$data->created_at->modify('+1 hour')->format('H:00')}}</td>
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
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('input1.edit', $data->id) }}" data-id="editInput131" class="btn btn-sm btn-info btn-icon mr-2">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('input1.destroy', $data->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button data-id="deleteInput131" class="btn btn-sm btn-danger btn-icon mr-2">
                                                        <i class="fas fa-times"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
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