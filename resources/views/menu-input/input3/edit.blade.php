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
        <h2 class="section-title">Edit Input3</h2>
        <div class="card">
            <form method="POST" action="{{ route('input3.update', $input3->id) }}" id="myForm" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Validasi Edit Data Input3</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="temp_water_in">Temp Water In</label>
                        <input type="number" class="form-control @error('temp_water_in') is-invalid @enderror" id="temp_water_in" name="temp_water_in" value="{{$input3->temp_water_in}}">
                        @error('temp_water_in')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="temp_water_out">Temp Water Out</label>
                        <input type="number" class="form-control @error('temp_water_out') is-invalid @enderror" id="temp_water_out" name="temp_water_out" value="{{$input3->temp_water_out}}">
                        @error('temp_water_out')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="temp_oil_in">Temp Oil In</label>
                        <input type="number" class="form-control @error('temp_oil_in') is-invalid @enderror" id="temp_oil_in" name="temp_oil_in" value="{{$input3->temp_oil_in}}">
                        @error('temp_oil_in')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="temp_oil_out">Temp Oil Out</label>
                        <input type="number" class="form-control @error('temp_oil_out') is-invalid @enderror" id="temp_oil_out" name="temp_oil_out" value="{{$input3->temp_oil_out}}">
                        @error('temp_oil_out')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="vacum">Vacum</label>
                        <input type="number" class="form-control @error('vacum') is-invalid @enderror" id="vacum" name="vacum" value="{{$input3->vacum}}">
                        @error('vacum')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="injector">Injector</label>
                        <input type="number" class="form-control @error('injector') is-invalid @enderror" id="injector" name="injector" value="{{$input3->injector}}">
                        @error('injector')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="speed_drop">Speed Drop</label>
                        <input type="number" class="form-control @error('speed_drop') is-invalid @enderror" id="speed_drop" name="speed_drop" value="{{$input3->speed_drop}}">
                        @error('speed_drop')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="load_limit">Load Limit</label>
                        <input type="number" class="form-control @error('load_limit') is-invalid @enderror" id="load_limit" name="load_limit" value="{{$input3->load_limit}}">
                        @error('load_limit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="flo_in">Flo In</label>
                        <input type="number" class="form-control @error('flo_in') is-invalid @enderror" id="flo_in" name="flo_in" value="{{$input3->flo_in}}">
                        @error('flo_in')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="flo_out">Flo Out</label>
                        <input type="number" class="form-control @error('flo_out') is-invalid @enderror" id="flo_out" name="flo_out" value="{{$input3->flo_out}}">
                        @error('flo_out')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('input3.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection