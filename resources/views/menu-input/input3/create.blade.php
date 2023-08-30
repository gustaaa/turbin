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
        <h2 class="section-title" data-id="titleAddInput3">Tambah Input3</h2>

        <div class="card">
            <div class="card-header">
                <h4>Validasi Tambah Data</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('input3.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="temp_water_in">Temp Water In</label>
                        <input type="number" data-id="inputTempWaterInInput3" class="form-control @error('temp_water_in') is-invalid @enderror" id="temp_water_in" name="temp_water_in" placeholder="Enter Data">
                        @error('temp_water_in')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="temp_water_out">Temp Water Out</label>
                        <input type="number" data-id="inputTempWaterOutInput3" class="form-control @error('temp_water_out') is-invalid @enderror" id="temp_water_out" name="temp_water_out" placeholder="Enter Data">
                        @error('temp_water_out')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="temp_oil_in">Temp Oil In</label>
                        <input type="number" data-id="inputTempOilInInput3" class="form-control @error('temp_oil_in') is-invalid @enderror" id="temp_oil_in" name="temp_oil_in" placeholder="Enter Data">
                        @error('temp_oil_in')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="temp_oil_out">Temp Oil Out</label>
                        <input type="number" data-id="inputTempOilOutInput3" class="form-control @error('temp_oil_out') is-invalid @enderror" id="temp_oil_out" name="temp_oil_out" placeholder="Enter Data">
                        @error('temp_oil_out')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="vacum">Vacum</label>
                        <input type="number" data-id="inputVacumInput3" class="form-control @error('vacum') is-invalid @enderror" id="vacum" name="vacum" placeholder="Enter Data">
                        @error('vacum')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="injector">Injector</label>
                        <input type="number" data-id="inputInjectorInput3" class="form-control @error('injector') is-invalid @enderror" id="injector" name="injector" placeholder="Enter Data">
                        @error('injector')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="speed_drop">Speed Drop</label>
                        <input type="number" data-id="inputSpeedDropInput3" class="form-control @error('speed_drop') is-invalid @enderror" id="speed_drop" name="speed_drop" placeholder="Enter Data">
                        @error('speed_drop')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="load_limit">Load Limit</label>
                        <input type="number" data-id="inputLoadLimitInput3" class="form-control @error('load_limit') is-invalid @enderror" id="load_limit" name="load_limit" placeholder="Enter Data">
                        @error('load_limit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="flo_in">Flo In</label>
                        <input type="number" data-id="inputFloInInput3" class="form-control @error('flo_in') is-invalid @enderror" id="flo_in" name="flo_in" placeholder="Enter Data">
                        @error('flo_in')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="flo_out">Flo Out</label>
                        <input type="number" data-id="inputFloOutInput3" class="form-control @error('flo_out') is-invalid @enderror" id="flo_out" name="flo_out" placeholder="Enter Data">
                        @error('flo_out')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" data-id="btnAddInput3">Submit</button>
                <a class="btn btn-secondary" href="{{ route('input3.index') }}">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</section>
@endsection