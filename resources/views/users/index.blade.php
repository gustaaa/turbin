@extends('layouts.app')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1>User List</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title" data-id="titleUserManagement">User Management</h2>
        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 data-id="userListData">User List</h4>
                        <div class="card-header-action">
                            <a class="btn btn-info icon-left btn-primary" data-id="userAdd" href="{{ route('user.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Create New User</a>
                            <a class="btn btn-info btn-primary active" href="{{ url('/laporan/user') }}">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                Download User</a>
                            <a class="btn btn-info btn-primary active" href="{{ route('user.export') }}">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                Export User</a>
                            <a class="btn btn-info btn-primary active search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Search User</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="show-search mb-3" style="display: none">
                            <form id="search" method="GET" action="{{ route('user.index') }}">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="role">User</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="User Name">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <a class="btn btn-secondary" href="{{ route('user.index') }}">Reset</a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th data-id="thName">Name</th>
                                        <th data-id="thUsername">Username</th>
                                        <th data-id="thEmail">Email</th>
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->created_at}}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('user.show', $user->id) }}" data-id="viewUser31" class="btn btn-success btn-icon btn-sm mr-2">
                                                    <i class="fas fa-eye"></i>
                                                    View
                                                </a>
                                                <a href="{{ route('user.edit', $user->id) }}" data-id="editUser31" class="btn btn-sm btn-info btn-icon mr-2">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button data-id="deleteUser31" class="btn btn-sm btn-danger btn-icon mr-2">
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
                            <div class="d-flex justify-content-center">
                                {{ $users->withQueryString()->links() }}
                            </div>
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
        $('.import').click(function(event) {
            event.stopPropagation();
            $(".show-import").slideToggle("fast");
            $(".show-search").hide();
        });
        $('.search').click(function(event) {
            event.stopPropagation();
            $(".show-search").slideToggle("fast");
            $(".show-import").hide();
        });
        //ganti label berdasarkan nama file
        $('#file-upload').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#file-upload')[0].files[0].name;
            $(this).prev('label').text(file);
        });
    });
</script>
@endpush

@push('customStyle')
@endpush