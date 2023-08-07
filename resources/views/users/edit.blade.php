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
            <form method="POST" action="{{ route('user.update', $user->id) }}" id="myForm" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Validasi Edit Data User</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $user->username }}">
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="custom-select col-12" type="role" name="role" id="role">
                            <option value="Administrator" @if($user->role == 'Administrator') selected @endif>Administrator</option>
                            <option value="Operator" @if($user->role == 'Operator') selected @endif>Operator</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="gambar">Gambar</label>
                        <div class="col-sm-12 col-md-12">
                            <img class="product" width="200" height="200" @if($user->gambar) src="{{ asset('storage/'.$user->gambar) }}" @endif />
                            <input class="uploads form-control" type="file" style="margin-top: 20px;" name="gambar"></br>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('user.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection