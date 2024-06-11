@extends('users.hod.app')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard
                            @foreach($departments as $department) 
                            @if(Auth::user()->department_id == $department->department_id)
                               HOD ({{ $department->department_name }})
                            @endif
                            @endforeach
                        </h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Fees Paid  -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body table-responsive">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Graduating Students</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $students->count() }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-globe fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fees Remaining -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body table-responsive">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Number Approved for Graduation</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $approved->count() }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Pending Approval Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body table-responsive">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Not Approved</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $students->count() - $approved->count()}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-times fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body table-responsive">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Overall Clearance Progress
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        @if($students->count() == '0')
                                                            {{$progPercent = 0}}
                                                        @else
                                                        {{
                                                            $progPercent = round(((($approved->count())/$students->count()) * 100),2)
                                                        }}
                                                        @endif
                                                        %
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: {{$progPercent}}%" aria-valuenow="{{$progPercent}}" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid mb-4">
                        <div class="card">
                            <div class="card-header">
                            <i class="fas fa-list"></i> &nbspPrograms In your Department
                            </div>
                            <div class="card-body table-responsive">
                            <table class="table table-hover table-stripped table-bordered"  id="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Program Type</th>
                <th scope="col">Program Name</th>
                <th scope="col">Program Code</th>
                </tr>
            </thead>
            <tbody>
                <span style="display:none">
                    {{$i=1}}
                </span>
                @if($programs->count()>0)
                    @foreach($programs as $program)
                    @if($program->department_id == Auth::User()->department_id)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{ucwords($program->program_type)}}</td>
                            <td>{{ucwords($program->program_name)}}</td>
                            <td>{{strtoupper($program->program_code) }}</td>
                        </tr>
                        <span style="display:none">
                            {{$i++}}
                        </span>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="11"><div class="alert alert-danger">No Program Record Found</div></td>
                    </tr>
                @endif
            </tbody>
            </table>
                            </div>
                        </div>
                    </div>
@endsection