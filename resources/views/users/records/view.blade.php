@extends('users.records.app')

@section('content')
<!-- Dropdown - Messages -->

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Student Clearance (Records Office)</h1>
</div>
<div class="row mb-4">
<div class="mx-auto justify-content-center col-md-6 text-center" id="mydiv">
        <div>
            @if(session()->has('message'))
            {{$errclass=''}}
            <span style="display:none">
                @if(str_contains(session('message'), 'no'))
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
    <div class=" container-fluid">
        <div class="card mx-auto">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-7 mb-2">
                        <i class="fas fa-users"></i>
                        &nbsp Student Clearance
                    </div>
                    <div class="col-md-5">
                        <form method="GET" action="#" class="form-inline">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="search" placeholder="Search User" name="search" class="form-control form-control-sm"/>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mb-2"><i class="fas fa-search"></i> &nbsp{{ __('Search') }}</button>
                            &nbsp<a href="{{url()->previous()}}" class="btn btn-primary btn-sm float-right mb-2"><i class="fas fa-arrow-left"></i>&nbsp<span class="d-none d-lg-inline">Back</span></a>
                        </form>
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
                <th scope="col">Department</th>
                <th scope="col">Certificate Serial Number</th>
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
                @if($clearances->contains('email',$record->email))
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
                    <td>
                        @if($certificates->isEmpty())
                        0
                        @else
                        @foreach($certificates as $certificate)
                        @if($certificates->contains('email', $record->email) && $certificate->email == $record->email)
                        {{$certificate->certificate_serial_number}}
                        @endif
                        @if(!$certificates->contains('email', $record->email))
                        0
                        @endif
                        @endforeach
                        @endif
                    </td>
                    <td scope="col-2">
                        @if($certificates->contains('email',$record->email))
                            @if($emailCleared->contains('email', $record->email))
                                <button class="btn btn-success btn-sm"><i class="fas fa-check"></i>&nbsp Student Cleared</button>
                            @else
                           <form method="POST" action="{{route('clearStuRecord', $record->email)}}">
                                @csrf
                                <input type="hidden" name="clearStudentRecord" value="picked">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i>&nbsp Clear Student</button>
                            </form>
                            @endif
                        @else
                           <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileUpload{{$record->student_id}}"><i class="fas fa-plus"></i>&nbsp Add Certificate</a>
                        @endif
                    </td>
                           <!-- File Upload Modal-->
                           <div class="modal fade" id="fileUpload{{$record->student_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                 <form method="POST" action="{{ route('addCert') }}" enctype="multipart/form-data">
                                          @csrf
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Add Certificate for {{$record->first_name.' '.$record->last_name}}</h5>
                                       <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">×</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                          <div class="row mb-3">
                                             <label for="file_upload" class="col-md-6 col-form-label text-md-end">{{ __('Select Certificate To Upload') }}</label>
                                             <div class="col-md-6">
                                                <input id="file_upload" type="file" class="form-control @error('file_upload') is-invalid @enderror" name="file_upload" single required autocomplete="new-file_upload">
                                                <input type="hidden" name="email" value="{{$record->email}}">
                                                <input type="hidden" name="department_id" value="{{$record->department_id}}">
                                                <input type="hidden" name="program_id" value="{{$record->program_id}}">
                                                <input type="hidden" name="certificate_serial_number" value="{{ rand(10001,99999) }}">
                                                @error('file_upload')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                             </div>
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="col-md-6 text-center">
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary btn-sm"> {{ __('Add Certificate') }}</button>
                                        </div>
                                    </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                </tr>
                @else
                @continue
                <tr>
                    <td colspan="8">
                        <div class="alert alert-danger">No Records Found</div>
                    </td>
                </tr>
                @endif
                @endforeach
                @endif
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection