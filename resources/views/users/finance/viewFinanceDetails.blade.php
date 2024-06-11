@extends('users.finance.app')

@section('content')
<!-- Dropdown - Messages -->

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Students Names</h1>
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
                    <div class="col-md-6 mb-2">
                        <i class="fas fa-graduation-cap"></i>
                        &nbsp Finance Details for Approved Graduating Students
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <form method="GET" action="#" class="form-inline float-left">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="search" placeholder="Search student" name="search" class="form-control form-control-sm"/>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mb-2"><i class="fas fa-search"></i> &nbsp{{ __('Search') }}</button>
                        </form>
                        <a href="{{url()->previous()}}" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> <span class="d-none d-lg-inline">Back</span></a>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive">
            <table class="table table-hover table-stripped table-bordered" " id="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Admission No.</th>
                <th scope="col">Department</th>
                <th scope="col">Program</th>
                <th scope="col">Program Code</th>
                <th scope="col">School Fees</th>
                <th scope="col">Gown Fees</th>
                <th scope="col-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <span style="display:none">
                    {{$i=1}}
                </span>
                @if($students->count()>0)
                    @foreach($finances as $finance)
                    @foreach($students as $student)
                        @if($finance->email == $student->email)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$student->first_name}}</td>
                            <td>{{$student->last_name}}</td>
                            <td>{{$student->admissionNumber}}</td>
                                @foreach($departments as $department)
                                    @if($student->department_id == $department->department_id)
                                    <td>
                                        {{ $department->department_name }}
                                    </td>
                                    @endif
                                @endforeach
                                @foreach($programs as $program)
                                    @if($student->program_id == $program->program_id)
                                    <td>
                                        {{ $program->program_name }}
                                    </td>
                                    <td>
                                        {{ $program->program_code }}
                                    </td>
                                    @endif
                                @endforeach
                            <td>{{$finance->school_fees }}</td>
                            <td>{{$finance->gown_fees }}</td>
                            <td scope="col-2"> 
                                <div class="d-flex justify-contents-center">
                                    <a href="{{url('clearViewFinance', $student->student_id)}}" class="btn btn-info btn-sm">
                                        <i class="fas fa-check"></i> <span class="d-none d-lg-inline"> Clear</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <span style="display:none">
                            {{$i++}}
                        </span>
                        @endif
                    @endforeach
                    @endforeach
                @else
                    <tr>
                        <td colspan="11"><div class="alert alert-danger">No Student Record Found</div></td>
                    </tr>
                @endif
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection