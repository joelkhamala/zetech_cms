@extends('layouts.main')

@section('content')
<!-- Dropdown - Messages -->

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Registered Users</h1>
</div>
<div class="row mb-4">
    <div class=" container-fluid">
    <div class="mx-auto mb-4 justify-content-center col-md-6 text-center" id="mydiv">
        <div>
            @if(session()->has('message'))
            {{$errclass=''}}
            <span style="display:none">
                @if(str_contains(session('message'), 'are'))
                {{ $errclass='alert-danger'}}
                @else
                {{ $errclass='alert-success'}}
                @endif
            </span>
                <div class="alert {{$errclass}} alert-dismissible fade show mb-2" role="alert"  id="mydiv">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function(){
        $("#mydiv").fadeIn(500);
        $("#mydiv").fadeOut(5000);
    });
    </script>
        <div class="card mx-auto">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <i class="fas fa-users"></i>
                        &nbsp System Users
                    </div>
                    <div class="col-md-5">
                        <form method="GET" action="{{route('users.index')}}" class="form-inline">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="search" placeholder="Search User" name="search" class="form-control form-control-sm"/>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mb-2"><i class="fas fa-search"></i> &nbsp{{ __('Search') }}</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('users.create')}}" class="btn btn-primary btn-sm float-right">Create New User</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
            <table class="table table-hover table-stripped table-bordered" " id="table">
            <thead>
                <tr>
                <th scope="col">User ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Department</th>
                <th scope="col">Role ID</th>
                <th scope="col">User Role</th>
                <th scope="col-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->user_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach($departments as $department)
                        @if($user->department_id == '0')
                            Administrator
                            @break
                        @endif
                        @if($user->department_id == $department->department_id)
                        {{$department->department_name}}
                        @endif
                        @endforeach
                    </td>
                    <td>{{$user->role_id}}</td>
                    <td>
                        @foreach($roles as $role)
                        @if($user->role_id == $role->role_id)
                            @if($role->role_id == '1')
                                <div class="btn btn-primary">{{ $role->role_name }}</div>
                            @elseif($role->role_id == '2')
                                <div class="btn btn-info">{{ $role->role_name }}</div>
                            @elseif($role->role_id == '3')
                                <div class="btn btn-warning">{{ $role->role_name }}</div>
                            @elseif($role->role_id == '4')
                                <div class="btn btn-danger">{{ $role->role_name }}</div>
                            @elseif($role->role_id == '5')
                                <div class="btn btn-dark">{{ $role->role_name }}</div>
                            @elseif($role->role_id == '6')
                                <div class="btn btn-secondary">{{ $role->role_name }}</div>
                            @else
                                <div class="btn btn-success">{{ $role->role_name }}</div>
                            @endif
                        @endif
                        @endforeach
                    </td>
                    <td scope="col-2"><a href="{{route('users.edit', $user->id)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>&nbsp Edit User Details</a></td>
                </tr>
                @endforeach
                @if($users->isEmpty())
                    <tr>
                        <td colspan="12"><div class="alert alert-danger">No Users Added Yet</div></td>
                    </tr>
                @endif
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection