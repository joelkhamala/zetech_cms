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
                            {{ __('Update Gown') }}
                        </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                    <a href="{{url()->previous()}}" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Go Back</a>
                    </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('gowns.update', $gown->gown_id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="gown_serial_number" class="col-form-label text-md-end">{{ __('Gown Serial') }}</label>

                            <div class="">
                                <input id="gown_serial_number" type="text" class="form-control @error('gown_serial_number') is-invalid @enderror" value="{{ old('gown_serial_number', $gown->gown_serial_number) }}" disabled autocomplete="gown_serial_number" autofocus>
                                <input type="hidden" name="gown_serial_number" value="{{ old('gown_serial_number', $gown->gown_serial_number) }}">
                                @error('gown_serial_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="gown_size" class="col-form-label text-md-end">{{ __('Gown Size') }}</label>

                            <div class="">
                                <input id="gown_size" type="text" class="form-control @error('gown_size') is-invalid @enderror" value="{{ old('gown_size', ucwords($gown->size)) }}" disabled autocomplete="gown_size" autofocus>
                                <input type="hidden" name="gown_size" value="{{ old('gown_size', ucwords($gown->size)) }}">
                                @error('gown_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="gown_condition" class="col-form-label text-md-end">{{ __('Gown Condition') }}</label>

                            <div class="">
                                <input id="gown_condition" type="text" class="form-control @error('gown_condition') is-invalid @enderror" name="gown_condition" value="{{ old('gown_condition', $gown->condition) }}" required autocomplete="gown_condition" autofocus>

                                @error('gown_condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-0">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-pencil"></i> &nbsp
                                    {{ __('Update Gown') }}
                                </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection