@extends('layouts.app')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Table</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Edit Input1</h2>
        <div class="card">
            <form method="POST" action="{{ route('report1.update', $input1->id) }}" id="myForm" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Validasi Edit Data Input1</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inlet_steam">Inlet Steam</label>
                        <input type="number" class="form-control @error('inlet_steam') is-invalid @enderror" id="inlet_steam" name="inlet_steam" value="{{$input1->inlet_steam}}">
                        @error('inlet_steam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exm_steam">Exm Steam</label>
                        <input type="number" class="form-control @error('exm_steam') is-invalid @enderror" id="exm_steam" name="exm_steam" value="{{$input1->exm_steam}}">
                        @error('exm_steam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="turbin_thrust_bearing">Turbin Thrust Bearing</label>
                        <input type="number" class="form-control @error('turbin_thrust_bearing') is-invalid @enderror" id="turbin_thrust_bearing" name="turbin_thrust_bearing" value="{{$input1->turbin_thrust_bearing}}">
                        @error('turbin_thrust_bearing')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tb_gov_side">TB Gov Side</label>
                        <input type="number" class="form-control @error('tb_gov_side') is-invalid @enderror" id="tb_gov_side" name="tb_gov_side" value="{{$input1->tb_gov_side}}">
                        @error('tb_gov_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tb_coup_side">TB Coup Side</label>
                        <input type="number" class="form-control @error('tb_coup_side') is-invalid @enderror" id="tb_coup_side" name="tb_coup_side" value="{{$input1->tb_coup_side}}">
                        @error('tb_coup_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pb_tbn_side">PB Tbn Side</label>
                        <input type="number" class="form-control @error('pb_tbn_side') is-invalid @enderror" id="pb_tbn_side" name="pb_tbn_side" value="{{$input1->pb_tbn_side}}">
                        @error('pb_tbn_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pb_gen_side">PB Gen Side</label>
                        <input type="number" class="form-control @error('pb_gen_side') is-invalid @enderror" id="pb_gen_side" name="pb_gen_side" value="{{$input1->pb_gen_side}}">
                        @error('pb_gen_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="wb_tbn_side">WB Tbn Side</label>
                        <input type="number" class="form-control @error('wb_tbn_side') is-invalid @enderror" id="wb_tbn_side" name="wb_tbn_side" value="{{$input1->wb_tbn_side}}">
                        @error('wb_tbn_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="wb_gen_side">WB Gen Side</label>
                        <input type="number" class="form-control @error('wb_gen_side') is-invalid @enderror" id="wb_gen_side" name="wb_gen_side" value="{{$input1->wb_gen_side}}">
                        @error('wb_gen_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="oc_lub_oil_outlet">OC Lub Oil Outlet</label>
                        <input type="number" class="form-control @error('oc_lub_oil_outlet') is-invalid @enderror" id="oc_lub_oil_outlet" name="oc_lub_oil_outlet" value="{{$input1->oc_lub_oil_outlet}}">
                        @error('oc_lub_oil_outlet')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('report1.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection