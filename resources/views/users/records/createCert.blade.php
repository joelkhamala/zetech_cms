@extends('users.records.app')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between">
   <h1 class="h3 mb-0 text-gray-800">Add Certificate</h1>
</div>
<div class="container-fluid mb-4">
   <div class="mx-auto mb-4 justify-content-center col-md-6 text-center" id="mydiv">
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
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <i class="fas fa-file-text"></i>&nbsp
               {{ __('Add New Certificates') }}
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
                        <th scope="col-2">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if($records->count()<=0)
                     <tr>
                        <td colspan="12">
                           <div class="alert alert-danger">No Records Found</div>
                        </td>
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
                        <td scope="col-2">
                        @if($certificates->contains('email',$record->email))
                           <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#fileDelete{{$record->student_id}}"><i class="fas fa-eye"></i>&nbsp View Certificate</a>
                        @else
                           <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileUpload{{$record->student_id}}"><i class="fas fa-plus"></i>&nbsp Add Certificate</a>
                        @endif
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

                           <!-- File Upload Modal-->
                           <div class="modal fade" id="fileDelete{{$record->student_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Certificate Details for {{$record->first_name.' '.$record->last_name}}</h5>
                                       <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">×</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                          <table class="table">
                                          <thead>
                                             <tr>
                                                <th scope="col">Certificate Serial Number</th>
                                                <th scope="col">Document Name</th>
                                                <th scope="col">Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                          @foreach($certificates as $certificate)
                                          @if($certificates->contains('email', $record->email) && $record->email==$certificate->email)
                                             <tr>
                                                <td>
                                                   {{$certificate->certificate_serial_number}}
                                                </td>
                                                <td>
                                                   {{$certificate->file_name}}
                                                </td>
                                                <td>
                                                <form method="POST" action="{{ route('delCert', $certificate->certificate_id)}}">
                                                   @csrf
                                                   <input type="hidden" name="file_delete" value="{{$certificate->file_name}}">
                                                   <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> &nbsp{{ __('Delete Certificate') }}</button>
                                                </form>
                                                </td>
                                             <tr>
                                                @endif
                                                @endforeach
                                          </tbody>
                                          </table>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="col-md-2 text-center">
                                            <button class="btn btn-warning btn-sm" type="button" data-dismiss="modal"><i class="fas fa-ban"></i> &nbspCancel</button>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                     </tr>
                     @endforeach
                     @endif
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection