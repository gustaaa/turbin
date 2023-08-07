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
					<div class="form-group row">
						<label for="name" class="col-sm-12 col-md-2 col-form-label text-black">Nama</label>
						<div class="col-sm-12 col-md-10">
							<input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}" aria-describedby="name" placeholder="">
						</div>
					</div>
					<div class="form-group row">
						<label for="username" class="col-sm-12 col-md-2 col-form-label text-black">Username</label>
						<div class="col-sm-12 col-md-10">
							<input class="form-control" type="text" name="username" id="username" value="{{ $user->username }}" aria-describedby="username" placeholder="">
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-sm-12 col-md-2 col-form-label text-black">Email</label>
						<div class="col-sm-12 col-md-10">
							<input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}" aria-describedby="email" placeholder="">
						</div>
					</div>
					<div class="form-group row">
						<label for="role" class="col-sm-12 col-md-2 col-form-label text-black">Role</label>
						<div class="col-sm-12 col-md-10">
							<select class="custom-select col-12" type="role" name="role" id="role">
								<option value="Administrator" @if($user->role == 'Administrator') selected @endif>Administrator</option>
								<option value="Operator" @if($user->role == 'Operator') selected @endif>Operator</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="gambar" class="col-sm-12 col-md-2 col-form-label text-black">Gambar</label>
						<div class="col-sm-12 col-md-10">
							<img class="product" width="200" height="200" @if($user->gambar) src="{{ asset('storage/'.$user->gambar) }}" @endif />
							<input class="uploads form-control" type="file" style="margin-top: 20px;" name="gambar"></br>
						</div>
					</div>
					<div class="form-group row">
						<label for="password" class="col-sm-12 col-md-2 col-form-label text-black">Password</label>
						<div class="col-sm-12 col-md-10">
							<a href="{{route('edit.password', $user->id)}}" type="button" class="btn btn-info btn-lg btn-block">Edit Password</a>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<button class="btn btn-primary">Submit</button>
					<a class="btn btn-danger" href="{{ url('/home') }}">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection