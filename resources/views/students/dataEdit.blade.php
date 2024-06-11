@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                <i class="fa fa-pencil-square"></i>
                    {{ __('Update Student Login Details') }}
                    
                    <a href="{{route('students.index')}}" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>

                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('students.update', $student->student_id) }}">
                        @csrf
                        @method('PUT')
                    <div class="col-md-12 mt-2 mb-4">
                        <div class="card">
                            <div class="card-header"><i class="fas fa-unlock-alt"></i>&nbsp {{ __('Change Password') }}</div>

                            <div class="card-body">

                                    <!---
                                    <div class="row mb-3">
                                        <label for="old_password" class="col-md-4 col-form-label text-md-end">{{ __('Old Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="new-password">

                                            @error('old_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    --->

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                {{ __('Update Password') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </form>
    </div>
</div>

@endsection