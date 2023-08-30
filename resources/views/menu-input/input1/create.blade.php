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
        <h2 class="section-title" data-id="titleAddInput1">Tambah Input1</h2>

        <div class="card">
            <div class="card-header">
                <h4>Validasi Tambah Data</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('input1.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inlet_steam">Inlet Steam</label>
                        <input type="number" data-id="inputInletSteamInput1" class="form-control @error('inlet_steam') is-invalid @enderror" id="inlet_steam" name="inlet_steam" placeholder="Enter Data">
                        @error('inlet_steam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exm_steam">Exm Steam</label>
                        <input type="number" data-id="inputExmSteamInput1" class="form-control @error('exm_steam') is-invalid @enderror" id="exm_steam" name="exm_steam" placeholder="Enter Data">
                        @error('exm_steam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="turbin_thrust_bearing">Turbin Thrust Bearing</label>
                        <input type="number" data-id="inputTurbinThrustBearingInput1" class="form-control @error('turbin_thrust_bearing') is-invalid @enderror" id="turbin_thrust_bearing" name="turbin_thrust_bearing" placeholder="Enter Data">
                        @error('turbin_thrust_bearing')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tb_gov_side">TB Gov Side</label>
                        <input type="number" data-id="inputTBGovSideInput1" class="form-control @error('tb_gov_side') is-invalid @enderror" id="tb_gov_side" name="tb_gov_side" placeholder="Enter Data">
                        @error('tb_gov_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tb_coup_side">TB Coup Side</label>
                        <input type="number" data-id="inputTBCoupSideInput1" class="form-control @error('tb_coup_side') is-invalid @enderror" id="tb_coup_side" name="tb_coup_side" placeholder="Enter Data">
                        @error('tb_coup_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pb_tbn_side">PB Tbn Side</label>
                        <input type="number" data-id="inputPBTbnSideInput1" class="form-control @error('pb_tbn_side') is-invalid @enderror" id="pb_tbn_side" name="pb_tbn_side" placeholder="Enter Data">
                        @error('pb_tbn_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pb_gen_side">PB Gen Side</label>
                        <input type="number" data-id="inputPBGenSideInput1" class="form-control @error('pb_gen_side') is-invalid @enderror" id="pb_gen_side" name="pb_gen_side" placeholder="Enter Data">
                        @error('pb_gen_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="wb_tbn_side">WB Tbn Side</label>
                        <input type="number" data-id="inputWBTbnSideInput1" class="form-control @error('wb_tbn_side') is-invalid @enderror" id="wb_tbn_side" name="wb_tbn_side" placeholder="Enter Data">
                        @error('wb_tbn_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="wb_gen_side">WB Gen Side</label>
                        <input type="number" data-id="inputWBGenSideInput1" class="form-control @error('wb_gen_side') is-invalid @enderror" id="wb_gen_side" name="wb_gen_side" placeholder="Enter Data">
                        @error('wb_gen_side')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="oc_lub_oil_outlet">OC Lub Oil Outlet</label>
                        <input type="number" data-id="inputOCLubOilOutletInput1" class="form-control @error('oc_lub_oil_outlet') is-invalid @enderror" id="oc_lub_oil_outlet" name="oc_lub_oil_outlet" placeholder="Enter Data">
                        @error('oc_lub_oil_outlet')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" data-id="btnAddInput1">Submit</button>
                <a class="btn btn-secondary" href="{{ route('input1.index') }}">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</section>
@endsection