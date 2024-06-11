@extends('users.records.app')

@section('content')
<!-- Dropdown - Messages -->

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Student Records</h1>
</div>
<div class="row mb-4">
    <div class="m-2 justify-content-center">
        <div>
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <div class=" container-fluid">
        <div class="card mx-auto">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <i class="fas fa-users"></i>
                        &nbsp Student Records
                    </div>
                    
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-5">
                        <form method="GET" action="#" class="form-inline">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="search" placeholder="Search User" name="search" class="form-control form-control-sm"/>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mb-2"><i class="fas fa-search"></i> &nbsp{{ __('Search') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
            <table class="table table-hover table-stripped table-bordered" " id="table">
            <thead>
                <tr>
                <th scope="col">Student ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Department</th>
                <th scope="col-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($records->count()<=0)
                    <tr>
                        <td colspan="12"><div class="alert alert-danger">No Records Found</div></td>
                    </tr>
                @else
                @foreach($records as $record)
                <tr>
                    <th scope="row">{{$record->student_id}}</th>
                    <td>{{$record->first_name}}</td>
                    <td>{{$record->middle_name}}</td>
                    <td>{{$record->last_name}}</td>
                    <td>{{$record->email}}</td>
                    <td>
                        @foreach($departments as $department)
                        @if($record->department_id == '0')
                            Administrator
                            @break
                        @endif
                        @if($record->department_id == $department->department_id)
                        {{$department->department_name}}
                        @endif
                        @endforeach
                    </td>
                    <td scope="col-2"><a href="{{route('editRecord', $record->student_id)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>&nbsp Edit record Details</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection