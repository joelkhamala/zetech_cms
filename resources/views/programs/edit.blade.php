@extends('layouts.main')

@section('content')
<div class="container mb-4">
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <i class="fa fa-pencil-square"></i>
                            {{ __('Update Program') }}
                        </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                    <a href="{{url()->previous()}}" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Go Back</a>
                    </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('programs.update', $program->program_id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="program_name" class="col-form-label text-md-end">{{ __('Program Name') }}</label>

                            <div class="">
                                <input id="program_name" type="text" class="form-control @error('program_name') is-invalid @enderror" name="program_name" value="{{ old('program_name', $program->program_name) }}" required autocomplete="program_name" autofocus>

                                @error('program_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="program_code" class="col-form-label text-md-end">{{ __('Program Code') }}</label>

                            <div class="">
                                <input id="program_code" type="text" class="form-control @error('program_code') is-invalid @enderror" name="program_code" value="{{ old('program_code', $program->program_code) }}" required autocomplete="program_code" autofocus>

                                @error('program_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="program_type" class="col-md-4 col-form-label text-md-end">{{ __('Program Type') }}</label>

                            <div class="">
                                <select id="program_type" class="form-control @error('program_type') is-invalid @enderror" name="program_type" value="{{ old('program_type', $program->program_type) }}" required autocomplete="program_type" autofocus>
                                    <option value="{{ old('program_type', ucwords($program->program_type)) }}">{{ old('program_type', ucwords($program->program_type)) }}</option>
                                    <option value="artisan">Artisan</option>
                                    <option value="certificate">Certificate</option>
                                    <option value="diploma">Diploma</option>
                                    <option value="degree">Degree</option>
                                    <option value="masters">Masters</option>
                                    <option value="phd">PHD</option>
                                </select>
                                @error('program_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="department_id" class="col-md-4 col-form-label text-md-end">{{ __('School/Department') }}</label>

                            <div class="">
                            <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" required>
                                    @foreach($departments as $department)
                                    @if($program->department_id == '0')
                                        <option>Select Department...</option>
                                        @break
                                    @endif
                                    @if($program->department_id == $department->department_id)
                                        <option value="{{ $department->department_id }}"> {{ $department->department_name }}</option>
                                        @break
                                    @endif
                                    @endforeach

                                    @foreach($departments as $department)
                                        <option value="{{ $department->department_id }}"> {{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-0">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-pencil"></i> &nbsp
                                    {{ __('Update Program') }}
                                </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection