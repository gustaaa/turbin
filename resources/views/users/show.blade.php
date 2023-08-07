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
        <h2 class="section-title" data-id="titleAddUser">Detail User</h2>

        <div class="card">
            <div class="card-header">
                <h4>Show Detail Data User</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.index') }}" method="post">
                    @csrf
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="pd-30 card-box height-50-p" style="padding-left: 250px;margin-bottom: 25px;">
                            <img height="200" width="200" @if($user->gambar) src="{{ asset('storage/'.$user->gambar) }}" @endif />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="product-detail-desc pd-20 card-box height-100-p">
                            <form>
                                <div class="form-group row" style="padding-left: 25px">
                                    <label for="name" class="col-sm-10 col-md-3 col-form-label text-black">Nama</label>
                                    <div class="col-md-8 col-sm-12">
                                        <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}" aria-describedby="name" placeholder="Disabled input" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row" style="padding-left: 25px">
                                    <label for="username" class="col-sm-10 col-md-3 col-form-label text-black">Username</label>
                                    <div class="col-md-8 col-sm-12">
                                        <input class="form-control" type="text" name="username" id="username" value="{{ $user->username }}" aria-describedby="name" placeholder="Disabled input" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row" style="padding-left: 25px">
                                    <label for="email" class="col-sm-10 col-md-3 col-form-label text-black">Email</label>
                                    <div class="col-md-8 col-sm-12">
                                        <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}" aria-describedby="email" placeholder="Disabled input" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row" style="padding-left: 25px">
                                    <label for="role" class="col-sm-10 col-md-3 col-form-label text-black">Role</label>
                                    <div class="col-md-8 col-sm-12">
                                        <input class="form-control" type="text" name="role" id="role" value="{{ $user->role }}" aria-describedby="role" placeholder="Disabled input" disabled="">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
            <div class="card-footer text-right">
                <a class="btn btn-danger" href="{{ route('user.index') }}">Kembali</a>
            </div>
            </form>
        </div>
    </div>
</section>
@endsection