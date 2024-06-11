@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Gown</h1>
</div>
<div class="container mb-4">
<div class="container text-center">
   @if(session()->has('message'))
   <div class="container">
      <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
         {{ session('message') }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
   </div>
   @endif
</div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <i class="fas fa-graduation-cap"></i>&nbsp
                    {{ __('Add New Gown(s)') }}
                    <a href="{{url()->previous()}}" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Go Back</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('gowns.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="gown_size" class="col-md-4 col-form-label text-md-end">{{ __('Gown Size') }}</label>

                            <div class="col-md-6">
                                <select id="gown_size" type="text" class="form-control @error('gown_size') is-invalid @enderror" name="gown_size" required autocomplete="gown_size" autofocus>
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                </select>
                                @error('gown_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gown_condition" class="col-md-4 col-form-label text-md-end">{{ __('Gown Condition') }}</label>

                            <div class="col-md-6">
                                <input id="gown_condition" type="text" class="form-control @error('gown_condition') is-invalid @enderror" name="gown_condition" value="{{ old('gown_condition') }}" required autocomplete="gown_condition" autofocus>

                                @error('gown_condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="number_of_gowns" class="col-md-4 col-form-label text-md-end">{{ __('Number of Gowns') }}</label>

                            <div class="col-md-6">
                                <input id="number_of_gowns" type="number" class="form-control @error('number_of_gowns') is-invalid @enderror" name="number_of_gowns" value="{{ old('number_of_gowns') }}" required autocomplete="number_of_gowns" autofocus>

                                @error('number_of_gowns')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-save"></i> &nbsp
                                    {{ __('Add Gown') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection