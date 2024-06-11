@extends('users.librarian.app')
@section('content')
<div class="container-fluid">
   <div class="row">
   <div class="justify-content-center mx-auto col-md-6 text-center">
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
      <div class="col-md-7 mb-4">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-4 mb-2">
                     <i class="fa fa-pencil-square"></i>
                     {{ __('Update Student Record') }}
                  </div><div class="col-md-4"></div>
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                     <a href="{{url()->previous()}}" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
                     <!-- &nbsp
                        <a href="{{route('students.create')}}" class="btn btn-primary btn-sm mb-2">
                            <i class="fas fa-user-plus"></i>
                            &nbsp <span class="d-none d-lg-inline ">Add New Student</span>
                        </a> -->
                  </div>
               </div>
            </div>
            <div class="card-body">
               <form method="POST" action="{{ route('saveLibRecord') }}">
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
                        @if($student->department_id == $department->department_id)
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
                  <div class="row mb-3">
                     <div class="col-md-12" >
                        <h3>Add Books</h3>
                        <div id="field">
                           <div id="field0">
                              <div class="row mb-3">
                                 <div class="col-md-10">
                                    <div class="row">
                                       <div class="col-md-3">
                                          <label for="book_title" class="col-form-label text-md-end">
                                          Book Title
                                          </label>
                                          <input type="hidden" name="not_cleared">
                                          <input type="text" class="form-control @error('book_title') is-invalid @enderror" name="book_title[]" placeholder="Book Title" value="{{ old('book_title') }}" required>
                                       </div>
                                       <div class="col-md-3">
                                          <label for="book_name" class="col-form-label text-md-end">
                                          Book Name
                                          </label>
                                          <input type="text"  class="form-control @error('book_name') is-invalid @enderror" name="book_name[]" placeholder="Book Name" value="{{ old('book_name') }}" required>
                                       </div>
                                       <div class="col-md-3">
                                          <label for="book_author" class="col-form-label text-md-end">
                                          Book Author
                                          </label>
                                          <input type="text"  class="form-control @error('book_author') is-invalid @enderror" name="book_author[]" placeholder="Book Author" value="{{ old('book_author') }}" required>
                                       </div>
                                       <div class="col-md-3">
                                          <label for="book_name" class="col-form-label text-md-end">
                                          Date Borrowed
                                          </label>
                                          <input type="date"  class="form-control @error('date_borrowed') is-invalid @enderror" name="date_borrowed[]" placeholder="Date Borrowed" value="{{ old('date_borrowed') }}" required>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                           <div class="float-right">
                              <button id="add-more" name="add-more" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> &nbspAdd More</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row mb-0">
                     <div class="col-md-6 ">
                        <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-save"></i>&nbsp
                        {{ __('Update Student Library Record') }}
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-md-5 mb-4">
         <div class="container-fluid table-responsive card shadow-sm">
            <div class="text-center"><h4 class="mt-4">Books Owing School</h4></div>
            @if($libraryDetails->isEmpty())
            <div class="alert alert-danger">
               <span class="mb-2">No Records Found </span>
               <form method="POST" action="{{route('clearLibRecord', $student->student_id)}}">
                  @csrf
                  @method('POST')
                  <button class="btn btn-primary btn-sm mt-2"><i class="fas fa-check"></i> Clear {{ $student->first_name }} For graduation?</button>
               </form>
            </div>
            @else
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th scope="col">Book Title</th>
                     <th scope="col">Book Name</th>
                     <th scope="col">Book Author</th>
                     <th scope="col">Date Borrowed</th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($libraryDetails as $libraryDetail)
                  <tr>
                     <td>{{ $libraryDetail->book_title }}</td>
                     <td>{{ $libraryDetail->book_name }}</td>
                     <td>{{ $libraryDetail->book_author }}</td>
                     <td>{{ $libraryDetail->date_borrowed }}</td>
                     <td scope="col-2"> 
                        <div class="d-flex justify-contents-center">
                           <form method="POST" action="{{route('clearBook')}}">
                           @csrf
                              <input type="hidden" name="email" value="{{$libraryDetail->email}}">
                              <input type="hidden" name="clearBook" value="yes">
                              <input type="hidden" name="clearSave" value="yes">
                              <input type="hidden" name="student_id" value="{{$student->student_id}}">
                              <input type="hidden" name="book_id" value="{{$libraryDetail->librarian_id}}">
                              <button type="submit" class="btn btn-info btn-sm">
                                 <i class="fas fa-check"></i> <span class="d-none d-lg-inline">Returned</span>
                              </button>
                           </form>
                        </div>
                    </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            @endif
         </div>
      </div>
   </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container-fluid">
</div>
<script>
   $(document).ready(function () {
   //@naresh action dynamic childs
   var next = 0;
   $("#add-more").click(function(e){
   e.preventDefault();
   var addto = "#field" + next;
   var addRemove = "#field" + (next);
   next = next + 1;
   var newIn = ' <div id="field'+ next +'" name="field'+ next +'"><!-- Text input--><div class="row mb-3"> <div class="row"> <div class="col-md-3"> <input type="text" class="form-control @error("book_title") is-invalid @enderror" name="book_title[]" placeholder="Book Title" value="{{ old("book_title") }}" required></div><div class="col-md-3"> <input type="text" class="form-control @error("book_name") is-invalid @enderror" name="book_name[]" placeholder="Book Name" value="{{ old("book_name") }}" required></div><div class="col-md-3"> <input type="text" class="form-control @error("book_author") is-invalid @enderror" name="book_author[]" placeholder="Book Author" value="{{ old("book_author") }}" required></div><div class="col-md-3"> <input type="date" class="form-control @error("date_borrowed") is-invalid @enderror" name="date_borrowed[]" placeholder="Date Borrowed" value="{{ old("date_borrowed") }}" required></div></div></div></div>';
   var newInput = $(newIn);
   var removeBtn = ' <button id="remove' + (next - 1) + '" class="btn btn-danger btn-sm remove-me float-right"> <i class="fas fa-trash"></i>&nbsp <span class="d-none d-lg-inline"> Remove</span></button>';
   var removeButton = $(removeBtn);
   $(addto).after(newInput);
   $(addRemove).after(removeButton);
   $("#field" + next).attr('data-source',$(addto).attr('data-source'));
   $("#count").val(next);  
   
       $('.remove-me').click(function(e){
           e.preventDefault();
           var fieldNum = this.id.charAt(this.id.length-1);
           var fieldID = "#field" + fieldNum;
           $(this).remove();
           $(fieldID).remove();
       });
   });
   
   });
</script>
@endsection