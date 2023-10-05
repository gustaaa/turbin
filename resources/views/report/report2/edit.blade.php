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
        <h2 class="section-title">Edit Input 2</h2>
        <div class="card">
            <form method="POST" action="{{ route('report2.update', $input2->id) }}" id="myForm" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Validasi Edit Data Input2</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="turbin_speed">Turbin Speed</label>
                        <input type="number" class="form-control @error('turbin_speed') is-invalid @enderror" id="turbin_speed" name="turbin_speed" value="{{$input2->turbin_speed}}">
                        @error('turbin_speed')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="rotor_vib_monitor">Rotor Vib Monitor</label>
                        <input type="number" class="form-control @error('rotor_vib_monitor') is-invalid @enderror" id="rotor_vib_monitor" name="rotor_vib_monitor" value="{{$input2->rotor_vib_monitor}}">
                        @error('rotor_vib_monitor')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="axial_displacement_monitor">Axial Displacement Monitor</label>
                        <input type="number" class="form-control @error('axial_displacement_monitor') is-invalid @enderror" id="axial_displacement_monitor" name="axial_displacement_monitor" value="{{$input2->axial_displacement_monitor}}">
                        @error('axial_displacement_monitor')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="main_steam">Main Steam</label>
                        <input type="number" class="form-control @error('main_steam') is-invalid @enderror" id="main_steam" name="main_steam" value="{{$input2->main_steam}}">
                        @error('main_steam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stage_steam">Stage Steam</label>
                        <input type="number" class="form-control @error('stage_steam') is-invalid @enderror" id="stage_steam" name="stage_steam" value="{{$input2->stage_steam}}">
                        @error('stage_steam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exhaust">Exhaust</label>
                        <input type="number" class="form-control @error('exhaust') is-invalid @enderror" id="exhaust" name="exhaust" value="{{$input2->exhaust}}">
                        @error('exhaust')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lub_oil">Lub Oil</label>
                        <input type="number" class="form-control @error('lub_oil') is-invalid @enderror" id="lub_oil" name="lub_oil" value="{{$input2->lub_oil}}">
                        @error('lub_oil')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="control_oil">Control Oil</label>
                        <input type="number" class="form-control @error('control_oil') is-invalid @enderror" id="control_oil" name="control_oil" value="{{$input2->control_oil}}">
                        @error('control_oil')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('report2.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection