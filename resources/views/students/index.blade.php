@extends('layouts.main')

@section('content')
<!-- Dropdown - Messages -->

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Students System Details</h1>
</div>
<div class="row mb-4">
    <div class="justify-content-center mx-auto">
        <div>
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show mb-2" student="alert">
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
                    <div class="col-md-7 mb-2">
                        <i class="fas fa-list-ol"></i>
                        &nbsp Students Details <span class="font-weight-bold">({{ $students->count() }} Record(s) found)</span>
                    </div>
                    <div class="col-md-5 d-flex align-items-center justify-content-center">
                        <form method="GET" action="{{route('students.index')}}" class="form-inline float-left">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="search" placeholder="Search student" name="search" class="form-control form-control-sm"/>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mb-2"><i class="fas fa-search"></i> &nbsp{{ __('Search') }}</button>
                        </form> &nbsp
                        <a href="{{url()->previous()}}" class="float-right btn btn-primary btn-sm mb-2"><i class="fas fa-arrow-left"></i> <span class="d-none d-lg-inline">Back</span></a>
                        <!-- <a href="{{route('students.create')}}" class="btn btn-primary btn-sm mb-2">
                            <i class="fas fa-user-plus"></i>
                            &nbsp <span class="d-none d-lg-inline ">Add New student</span>
                        </a> -->
                    </div>
                </div>
            </div>
            

            <div class="card-body table-responsive">
            <table class="table table-hover table-stripped table-bordered" " id="table">
            <thead>
                <tr>
                <th scope="col">Student ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">User Name</th>
                <th scope="col">Admission Number</th>
                <th scope="col-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <th scope="row">{{$student->student_id}}</th>
                    <td>{{$student->first_name}}</td>
                    <td>{{$student->last_name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->user_name}}</td>
                    <td>{{$student->admissionNumber}}</td>
                    <td scope="col-2"> 
                        <div class="d-flex justify-contents-center">
                            <a href="{{route('students.edit', $student->student_id)}}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a> &nbsp
                                <form method="POST" action="{{route('students.destroy', $student->student_id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @if($students->isEmpty())
                    <tr>
                        <td colspan="12"><div class="alert alert-danger">No Record Found</div></td>
                    </tr>
                @endif
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection