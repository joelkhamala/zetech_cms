@extends('users.hod.app')

@section('content')
<!-- Dropdown - Messages -->

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">View Remarks</h1>
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

    <div class=" container">
        <div class="card mx-auto">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 float-left">
                        <i class="fas fa-commenting"></i>
                        &nbsp Remarks Made to {{ $studentData->first_name .' '.$studentData->last_name}}
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <a href="{{url()->previous()}}" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> <span class="d-none d-lg-inline">Back</span></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @foreach($remarkData as $remarksData)
                @if($remarksData->remark_to == $studentData->student_id)
            <form>
                        @csrf

                        <input disabled type="hidden" name="user_id" value="{{Auth::User()->id}}">
                        <input disabled type="hidden" name="user_department_id" value="{{Auth::User()->department_id}}">
                        <input disabled type="hidden" name="remark_to" value="{{$studentData->student_id}}">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                    <label for="remark_title" class=" col-form-label text-md-end">{{ __('Remark Title') }}</label>
                                        <input disabled id="remark_title" type="text" class="form-control @error('remark_title') is-invalid @enderror" name="remark_title" value="{{ old('remark_title',$remarksData->remark_title) }}" required autocomplete="remark_title" autofocus>

                                        @error('remark_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                    <label for="issue" class=" col-form-label text-md-end">{{ __('Grant to Graduate') }}</label>
                                    <input disabled id="issue" type="text" class="form-control @error('issue') is-invalid @enderror" rows="5" name="issue" value="{{ old('issue',$remarksData->issue) }}" required autocomplete="issue" autofocus>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8 mb-3">
                                <label for="remark" class=" col-form-label text-md-end">{{ __('Remark') }}</label>

                                <div class="">
                                    <input disabled id="remark" type="text" class="form-control @error('remark') is-invalid @enderror" rows="5" name="remark" value="{{ old('remark',$remarksData->remark) }}" required autocomplete="remark" autofocus>

                                    @error('remark')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                    </form>
                    @break
                    @else
                    <div class="alert alert-danger">
                        <div class="row">
                            <div class="col-md-9">No Remarks Made</div>
                            <div class="col-md-3 text-white">
                                <a href="{{route('users.hod.addRemarks', ['department_id' => Auth::User()->department_id, 'student_id' => $studentData->student_id])}}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-commenting"></i>&nbsp Create Remark
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection