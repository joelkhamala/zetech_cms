@extends('users.hod.app')

@section('content')
<!-- Dropdown - Messages -->

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Confirmed Students Names
    </h1>
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
                        <i class="fas fa-thumbs-up"></i>
                        &nbsp Students who have confirmed Names
                        @foreach($departments as $department)
                        @if(Auth::User()->department_id == $department->department_id)
                            ({{ $department->department_name }})
                        @endif
                        @endforeach
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <form method="GET" action="{{route('users.hod.nameConfirm', Auth::User()->department_id)}}" class="form-inline float-left">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="search" placeholder="Search list by Student Name" name="search" class="form-control form-control-sm"/>
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
                <th scope="col">Student ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">National ID</th>
                <th scope="col">Program</th>
                <th scope="col">Program Code</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allStudents as $student)
                @if($student->confirmed == 'confirmed' && Auth::User()->department_id == $student->department_id)
                <tr>
                    <th scope="row">{{$student->student_id}}</th>
                    <td>{{$student->first_name}}</td>
                    <td>{{$student->middle_name}}</td>
                    <td>{{$student->last_name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->national_id }}</td>
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
                    <!-- <td>
                    @if($student->status_of_graduation == 'approved')
                        <button class="btn btn-success btn-sm">
                            <i class="fas fa-check"></i>
                            &nbsp{{ strtoupper($student->status_of_graduation) }}
                        </button>
                        @else
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-times"></i>
                            &nbsp{{ strtoupper($student->status_of_graduation) }}
                        </button>
                        @endif
                    </td> -->
                    <!-- <td>
                    @if($remarks->isEmpty())
                        No remark
                        @else
                            @foreach($remarks as $remark)
                            @if($student->student_id == $remark->remark_to)
                                {{ $remark->remark }}
                            @endif
                            @endforeach
                        @endif
                    </td> -->
                    <!-- <td scope="col-2"> 
                        <div class="d-flex juustify-contents-center">
                            <a href="{{route('students.edit', $student->student_id)}}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a> &nbsp
                                <form method="POST" action="{{route('students.destroy', $student->student_id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                        </div>
                    </td> -->
                    <td>
                    @if($depClears->contains('email', $student->email))
                            <button class="btn btn-info btn-sm"><i class="fas fa-check"></i> <span class="d-none d-lg-inline"> Student Cleared</span></button>
                            @else
                            <form method="POST" action="{{route('clearStudentDept', $student->student_id)}}">
                                @csrf
                                <input type="hidden" name="clear" value="cleared">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> <span class="d-none d-lg-inline"> &nbspClear Student</span></button>
                            </form>
                            <!-- <a href="{{route('users.hod.viewRemarks', ['department_id' => Auth::User()->department_id, 'student_id' => $student->student_id])}}" class="btn btn-info btn-sm">
                                <i class="fas fa-commenting"></i>
                            </a> &nbsp -->
                            @endif
                    </td>
                </tr>
                @endif
                @endforeach
                @if($allStudents->isEmpty())
                    <tr>
                        <td colspan="11"><div class="alert alert-danger">No Students have confirmed Names Yet</div></td>
                    </tr>
                @endif
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection