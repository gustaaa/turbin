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
        <h2 class="section-title">Edit User</h2>
        <div class="card">
            <form method="POST" action="{{ route('profile.update', $user->id) }}" id="myForm" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Validasi Edit Data User</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <form method="POST" action="{{ route('update.password', $user->id) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="password" class="col-sm-12 col-md-2 col-form-label text-black">Current Password</label>
                            <div class="col-sm-12 col-md-10">
                                <input id="password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current_password">
                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-12 col-md-2 col-form-label text-black">New Password</label>
                            <div class="col-sm-12 col-md-10">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-12 col-md-2 col-form-label text-black">Confirm Password</label>
                            <div class="col-sm-12 col-md-10">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="password_confirmation">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                                <button type="reset" class="btn btn-danger" href="{{ route('profile.edit', $user->id) }}">Kembali</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
</section>
@endsection