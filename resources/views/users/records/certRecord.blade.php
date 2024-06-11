@extends('users.records.app')
@section('content')
<div class="container-fluid">
   <div class="row">
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
      <div class="col-md-7 mb-4">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-4 mb-2">
                     <i class="fa fa-pencil-square"></i>
                    {{$student->first_name}}'s {{ __('Record') }}
                  </div><div class="col-md-4"></div>
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                     <a href="{{url('createTrans')}}" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
                     <!-- &nbsp
                        <a href="{{route('students.create')}}" class="btn btn-primary btn-sm mb-2">
                            <i class="fas fa-user-plus"></i>
                            &nbsp <span class="d-none d-lg-inline ">Add New Student</span>
                        </a> -->
                  </div>
               </div>
            </div>
            <div class="card-body">
               <form method="POST" action="">
                  @csrf
                  <div class="row mb-3">
                     <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                     <div class="col-md-8">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $student->first_name) }}" disabled>
                        <input type="hidden" name="first_name" value="{{ old('first_name', $student->first_name) }}">
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="middle_name" class="col-md-4 col-form-label text-md-end">{{ __('Admission Number') }}</label>
                     <div class="col-md-8">
                        <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" value="{{ old('middle_name', $student->middle_name) }}" disabled>
                        <input type="hidden" name="middle_name" value="{{ old('middle_name', $student->middle_name) }}">
                        @error('middle_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                     <div class="col-md-8">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $student->last_name) }}" disabled>
                        <input type="hidden" name="last_name" value="{{ old('last_name', $student->last_name) }}">
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="admissionNumber" class="col-md-4 col-form-label text-md-end">{{ __('Admission Number') }}</label>
                     <div class="col-md-8">
                        <input id="admissionNumber" type="text" class="form-control @error('admissionNumber') is-invalid @enderror" value="{{ old('admissionNumber', $student->admissionNumber) }}" disabled>
                        <input type="hidden" name="admissionNumber" value="{{ old('admissionNumber', $student->admissionNumber) }}">
                        @error('admissionNumber')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="department_id" class="col-md-4 col-form-label text-md-end">{{ __('School/Department') }}</label>
                     <div class="col-md-8">
                        @foreach($departments as $department)
                        @if($department_id == $department->department_id)
                        <input type="text" name="department_id"  class="form-control @error('department_id') is-invalid @enderror" value="{{ $department->department_name }}" disabled>
                        <input type="hidden" name="department_id" value="{{ $department->department_id }}">
                        <input type="hidden" name="email" value="{{ $student->email }}">
                        @break
                        @endif
                        @endforeach
                        @error('department_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="program_id" class="col-md-4 col-form-label text-md-end">{{ __('Program') }}</label>
                     <div class="col-md-8">
                        @foreach($programs as $program)
                        @if($student->program_id == $program->program_id)
                        <input type="text" name="program_id"  class="form-control @error('program_id') is-invalid @enderror" value="{{ $program->program_name }}" disabled>
                        <input type="hidden" name="program_id" value="{{ $program->program_id }}">
                        @endif
                        @endforeach
                        @error('program_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-md-5 mb-4">
         <div class="container-fluid table-responsive card shadow-sm">
            <div class="text-center"><h4 class="mt-4">Certificate For {{ $student->first_name}}</h4></div>
            @if($certificates->isEmpty())
            <div class="alert alert-danger">
               <span class="mb-2">No Records Found </span>
            </div>
            @else
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th scope="col">Serial Number</th>
                     <th scope="col">File</th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($certificates as $certificate)
                  @if($certificates->contains('email', $student->email) && $student->email==$certificate->email)
                  <tr>
                     <td>{{ $certificate->certificate_serial_number }}</td>
                     <td>{{ $certificate->file_name }}</td>
                     <td>
                        <form method="POST" action="{{ route('delCert', $certificate->certificate_id)}}">
                        @csrf
                        <input type="hidden" name="file_delete" value="{{$certificate->file_name}}">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                     <!-- <td scope="col-2"> 
                        <div class="d-flex justify-contents-center">
                           <form method="POST" action="">
                           @csrf
                              <input type="hidden" name="email" value="{{$certificate->email}}">
                              <button type="submit" class="btn btn-info btn-sm">
                                 <i class="fas fa-check"></i> <span class="d-none d-lg-inline">Returned</span>
                              </button>
                           </form>
                        </div>
                    </td> -->
                  </tr>
                  @elseif(!$certificates->contains('email', $student->email))
                  <div class="alert alert-danger">
                     <span class="mb-2">No Records Found </span>
                  </div>
                  @break
                  @else
                  <div></div>
                  @endif
                  @endforeach
               </tbody>
            </table>
            @endif
         </div>
      </div>
   </div>
</div>
@endsection