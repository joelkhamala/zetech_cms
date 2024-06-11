@extends('users.hod.app')

@section('content')

<div class="container mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <i class="fa fa-eye"></i>
                    {{ __('View student Details') }}
                    
                    <a href="{{url()->previous()}}" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="">
                        @csrf
                        <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="first_name" class="col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="">
                                <input disabled="disabled" class="form-control @error('first_name') is-invalid @enderror"  value="{{ old('first_name', $student->first_name) }}">

                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="middle_name" class=" col-form-label text-md-end">{{ __('Middle Name') }}</label>

                            <div class="">
                                <input disabled="disabled" class="form-control @error('middle_name') is-invalid @enderror" value="{{ old('middle_name', $student->middle_name) }}">

                                
                            </div>
                        </div>

                        
                        <div class="col-md-4 mb-3">
                            <label for="last_name" class="col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="">
                                <input disabled="disabled" class="form-control @error('last_name') is-invalid @enderror"  value="{{ old('last_name', $student->last_name) }}" >

                                
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="user_name" class=" col-form-label text-md-end">{{ __('User Name') }}</label>

                            <div class="">
                                <input  disabled="disabled" class="form-control @error('user_name') is-invalid @enderror" value="{{ old('user_name', $student->user_name) }}">

                            </div>
                        </div>


                        <div class="col-md-4 mb-3">
                            <label for="national_id" class="col-form-label text-md-end">{{ __('National ID') }}</label>

                            <div class="">
                                <input disabled="disabled" class="form-control @error('national_id') is-invalid @enderror"  value="{{ old('national_id', $student->national_id) }}" >

                            </div>
                        </div>
                        



                        <div class="col-md-4 mb-3">
                            <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="">
                                <input disabled="disabled" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email', $student->email) }}">

                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-4  mb-3">
                            <label for="phone" class="col-form-label text-md-end">{{ __('Student Contact') }}</label>

                            <div class="">
                                <input disabled="disabled" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $student->phone) }}">
                                    
                            </div>
                        </div>

                        <div class="col-md-4  mb-3">
                            <label for="department_id" class=" col-form-label text-md-end">{{ __('School/Department') }}</label>

                            <div class="">
                                    @foreach($departments as $department)
                                        @if($student->department_id == $department->department_id)
                                            <input type="text"  class="form-control @error('phone') is-invalid @enderror"  value="{{ old('department_id', $department->department_name) }}" disabled>

                                        @endif
                                    @endforeach
                            </div>
                        </div> 

                        <div class="col-md-4  mb-3">
                            <label for="program_id" class="col-form-label text-md-end">{{ __('Program') }}</label>

                            <div class="">
                                        @foreach($programs as $program)
                                            @if($student->program_id == $program->program_id)
                                            <input type="text"  class="form-control @error('phone') is-invalid @enderror"  value="{{ old('program_id', $program->program_name) }}" disabled>
                                            @endif
                                        @endforeach
                            </div>
                        </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="container">
@if($remarks->isEmpty())
<div class="col-md-12 mb-4">
			<div class="card">
				<div class="card-header">
					Remark
				</div>
				<div class="card-body">
                <div class="alert alert-danger"> No remarks Made</div>
                </div>
			</div>
		</div>
@else
    <h3 class="text-center mb-4">Remarks</h3>
    <div class="row mb-4">
    @foreach($remarks as $remark)
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					{{ $remark->remark_title }}
				</div>
				<div class="card-body">
                {{ $remark->remark }}
                </div>
			</div>
		</div>
    @endforeach
	</div>
@endif
</div>


<script>
    $(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
})
</script>


@endsection