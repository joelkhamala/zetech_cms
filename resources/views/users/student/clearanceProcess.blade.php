@extends('users.student.app')
@section('content')
<!--
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-8">
               <div class="card">
                   <div class="card-header">{{ __('Dashboard') }}</div>
   
                   <div class="card-body">
                       @if (session('status'))
                           <div class="alert alert-success" role="alert">
                               {{ session('status') }}
                           </div>
                       @endif
   
                       {{ __('You are logged in!') }}
                   </div>
               </div>
           </div>
       </div>
   </div>
   -->
<!-- Page Heading -->
@foreach($students as $student)
@if(Auth::User()->email == $student->email)
<span style="display:none">
    @if($depclearances->contains('email', Auth::User()->email))
    {{ $next= ''}}
    {{ $activedep = 'active' }}
    {{ $checkdep = 'fa-check' }}
    @else
    {{ $next = '#' }}
    {{ $activedep = '' }}
    {{ $checkdep = 'fa-user' }}
    @endif
    @if($libclearances->contains('email', Auth::User()->email))
    {{ $bookLock = ''}}
    {{ $activelib = 'active' }}
    {{ $checklib = 'fa-check' }}
    @else
    {{ $bookLock = '#'}}
    {{ $activelib = '' }}
    {{ $checklib = 'fa-book' }}
    @endif
    @if($finclearances->contains('email', Auth::User()->email))
    {{ $finLock = ''}}
    {{ $activefin = 'active' }}
    {{ $checkfin = 'fa-check' }}
    @else
    {{ $finLock = '#'}}
    {{ $activefin = '' }}
    {{ $checkfin = 'fa-usd' }}
    @endif
    @if($gownclearances->contains('email', Auth::User()->email))
    {{ $gownLock = ''}}
    {{ $activego = 'active' }}
    {{ $checkgo = 'fa-check' }}
    @else
    {{ $gownLock = '#'}}
    {{ $activego = '' }}
    {{ $checkgo = 'fa-graduation-cap' }}
    @endif
    @if($certclearances->contains('email', Auth::User()->email))
    {{ $certLock = ''}}
    {{ $activecer = 'active' }}
    {{ $checkcer = 'fa-check' }}
    @else
    {{ $certLock = '#'}}
    {{ $activecer = '' }}
    {{ $checkcer = 'fa-certificate' }}
    @endif
</span>
<div class="container">
   <div class="card card-timeline border-none">
      <h5 class="text-center mt-2 mb-0"><b>Clearance Progress</b></h5>
      <ul class="bs4-order-tracking">
         <li class="step {{$activedep}}">
            <div>
               <i class="fas {{$checkdep}}"></i>
            </div>
            Department
         </li>
         <li class="step {{$activelib}}">
            <div>
               <i class="fas {{$checklib}}"></i>
            </div>
            Library
         </li>
         <li class="step {{$activefin}}">
            <div>
               <i class="fas {{$checkfin}}"></i>
            </div>
            Finance
         </li>
         <li class="step {{$activego}}">
            <div>
               <i class="fas {{$checkgo}}"></i>
            </div>
            Gown
         </li>
         <li class="step {{$activecer}}">
            <div>
               <i class="fas {{$checkcer}}"></i>
            </div>
            Transcript & Certificates
         </li>
      </ul>
   </div>
   <style>
      .bs4-order-tracking{margin-bottom: 30px;overflow: hidden;color: #878788;padding-left: 0px;margin-top: 30px}
      .bs4-order-tracking li{list-style-type: none;font-size: 13px;width: 20%;float: left;position: relative;font-weight: 400;color: #878788;text-align: center}
      .bs4-order-tracking li:first-child:before{margin-left: 15px !important;padding-left: 11px !important;text-align : left !important}
      .bs4-order-tracking li:last-child:before{margin-right: 5px !important;padding-right: 11px !important;text-align : right !important}
      .bs4-order-tracking li>div{color: #fff;width: 29px;text-align: center;line-height: 29px;display: block;font-size: 12px;background: #878788;border-radius: 50%;margin: auto}
      .bs4-order-tracking li:after{content: '';width: 150%;height: 2px;background: #878788;position: absolute;left: 0%;right: 0%;top: 15px;z-index: -1}
      .bs4-order-tracking li:first-child:after{left: 50%}
      .bs4-order-tracking li:last-child:after{left: 0%!important;width: 0% !important}
      .bs4-order-tracking li.active{font-weight: bold;color: #228B22}
      .bs4-order-tracking li.active>div{background: #228B22}
      .bs4-order-tracking li.active:after{background: #228B22}.card-timeline{background-color: #fff;z-index: 0}
   </style>
   <!---------------Platform Tour----------------->
   <div class="mx-auto justify-content-center col-md-6 mb-2 mt-2 text-center" id="mydiv">
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
   <div class="platform-tour-wrapper py-4">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs justify-content-between border-0 horizontal-tabs-steps">
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#step1"><span>1</span>
            </a>
            <h6 class="text-center mt-2"> Department</h6>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#step2{{$next}}"><span>2</span></a>
            <h6 class="text-center mt-2">Library </h6>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#step3{{$next}}{{$bookLock}}"><span>3</span></a>
            <h6 class="text-center mt-2">Finance</h6>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#step4{{$next}}{{$bookLock}}{{$finLock}}"><span>4</span></a>
            <h6 class="text-center mt-2">Gown</h6>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#step5{{$next}}{{$bookLock}}{{$finLock}}{{$gownLock}}"><span>5</span></a>
            <h6 class="text-center mt-2" style="margin-left: -20px">Transcripts &<br> Certificate</h6>
         </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content platform-content mt-2 mb-4">
         <div id="step1" class="tab-pane active p-0">
            <h3 class="mb-4">Department Clearance</h3>
            <!------vertical Tabs------------->
            <div class="row">
               <div class="col-lg-1 col-md-2 col-sm-2 col-3 vertical-tabs-steps pr-0">
                  <ul class="nav nav-tabs d-flex flex-sm-column border-0" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#step1_1" role="tab" aria-controls="home"><span>Approval Status</span></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#step1_2" role="tab" aria-controls="profile"><span>Confirm Name</span></a>
                     </li>
                  </ul>
               </div>
               <div class="col-lg-11 col-md-10 col-sm-10 col-9 p-0 pl-md-2">
                  <div class="tab-content vertical-tabs-content">
                     <div class="tab-pane active" id="step1_1" role="tabpanel">
                        <h3 style="font-size:1.2rem; margin:0 0 1.5rem">Status of Name Approval by Senate</h3>
                        @if($student->status_of_graduation == 'approved')
                        <div class="card shadow">
                           <div class="card-body">
                              <div class="dummy-positioning text-center">
                                 <div class="success-icon">
                                    <div class="success-icon__tip"></div>
                                    <div class="success-icon__long"></div>
                                 </div>
                                 &nbsp
                                 <h2>Approved</h2>
                              </div>
                           </div>
                        </div>
                        @else
                        <div class="card shadow">
                           <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                              <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                              <span class="swal2-x-mark-line-right"></span>
                              </span>
                           </div>
                           <span class="text-center">
                              <h2>Not Approved</h2>
                           </span>
                        </div>
                        @endif
                     </div>
                     <div class="tab-pane" id="step1_2" role="tabpanel">
                        <h3 style="font-size:1.2rem; margin:0 0 1.5rem">Confirm Name</h3>
                        <div class="container-fluid">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="card">
                                    <div class="card-header">
                                       <i class="fa fa-pencil-square"></i>
                                       {{ __('Confirm Name (To be as it appears on your National ID)') }}
                                    </div>
                                    <div class="card-body">
                                       @if($student->status_of_graduation == 'approved')
                                       @if($student->confirmed == 'confirmed')
                                       <span style="display:none">
                                       {{ $btn_state = 'btn-success'}}
                                       {{ $fa_check = 'fa-check'}}
                                       {{ $disabled = 'disabled'}}
                                       {{$confirmBtn = 'Confirmed'}}
                                       </span>
                                       @else
                                       <span style="display:none">
                                       {{ $btn_state = 'btn-success'}}
                                       {{ $disabled = ''}}
                                       {{ $fa_check = 'fa-check'}}
                                       {{$confirmBtn='Confirm Name'}}
                                       </span>
                                       @endif
                                       @else
                                       <span style="display:none">
                                       {{ $btn_state = 'btn-danger'}}
                                       {{ $disabled = 'disabled'}}
                                       {{ $fa_check = 'fa-times'}}
                                       {{$confirmBtn = 'Not Approved'}}
                                       </span>
                                       @endif
                                       <form method="POST" action="{{ route('users.student.clearanceProcess', $student->email) }}">
                                          @csrf
                                          @method('POST')
                                          <div class="row mb-3">
                                             <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                                             <div class="col-md-6">
                                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $student->first_name) }}" required autocomplete="first_name" autofocus>
                                                <input type="hidden" name="student_id" value="{{ old('student_id', $student->student_id) }}" >
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                             </div>
                                          </div>
                                          <div class="row mb-3">
                                             <label for="middle_name" class="col-md-4 col-form-label text-md-end">{{ __('Middle Name') }}</label>
                                             <div class="col-md-6">
                                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name', $student->middle_name) }}" required autocomplete="middle_name" autofocus>
                                                @error('middle_name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                             </div>
                                          </div>
                                          <div class="row mb-3">
                                             <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                                             <div class="col-md-6">
                                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $student->last_name) }}" required autocomplete="last_name" autofocus>
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                             </div>
                                          </div>
                                          <div class="row mb-0">
                                             <div class="col-md-6">
                                                <button type="submit" class="btn {{ $btn_state }} btn-sm" {{$disabled}}>
                                                <i class="fas {{$fa_check}}"></i> &nbsp
                                                {{ __($confirmBtn) }}
                                                </button>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!---------- vertical Tabs End----------------->
         </div>
         <div id="step2" class="tab-pane fade p-0">
            <h3 class="mb-4">Library Clearance</h3>
            <!------vertical Tabs------------->
            <div class="row">
               <div class="col-lg-1 col-md-2 col-sm-2 col-3 vertical-tabs-steps pr-0">
                  <ul class="nav nav-tabs d-flex flex-sm-column border-0" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#step2_1" role="tab" aria-controls="home"><span>Books Borrowed</span></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#step2_2" role="tab" aria-controls="profile"><span>Clearance status</span></a>
                     </li>
                  </ul>
               </div>
               <div class="col-lg-11 col-md-10 col-sm-10 col-9 p-0 pl-md-2">
                  <div class="tab-content vertical-tabs-content">
                     <div class="tab-pane active" id="step2_1" role="tabpanel">
                        <h3 style="font-size:1.2rem; margin:0 0 1.5rem">Borrowed Books</h3>
                        <div class="row">
                           @if($books->isEmpty())
                           <div class="col-md-12 card shadow">
                              <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                                 <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                                 <span class="swal2-x-mark-line-right"></span>
                                 </span>
                              </div>
                              <span class="text-center">
                                 <h2>No Books Borrowed</h2>
                              </span>
                           </div>
                           @else
                           @foreach($books as $book)
                           @if($books->contains('email', Auth::User()->email) && $book->email == Auth::User()->email)
                           <div class="col-md-4 mb-2">
                              <div class="card shadow-sm">
                                 <div class="card-body">
                                    <div class="table-responsive">
                                       <table class="table table-stripped table-sm table-bordered">
                                          <tr>
                                             <td><span class="font-weight-bold">Book Title:</span></td>
                                             <td>{{ $book->book_title }}</td>
                                          </tr>
                                          <tr>
                                             <td><span class="font-weight-bold">Book Name:</span></td>
                                             <td>{{ $book->book_name }}</td>
                                          </tr>
                                          <tr>
                                             <td><span class="font-weight-bold">Book Author:</span></td>
                                             <td>{{ $book->book_author }}</td>
                                          </tr>
                                          <tr>
                                             <td><span class="font-weight-bold">Date Borrowed:</span></td>
                                             <td>{{ $book->date_borrowed }}</td>
                                          </tr>
                                          <tr>
                                             <td>
                                                <span class="font-weight-bold">Return Status:</span>
                                             </td>
                                             <td>
                                                @if($book->cleared == 'yes')
                                                <span class="text-success">Returned</span>
                                                @else
                                                <span class="text-danger">Not Returned</span>
                                                @endif
                                             </td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @else
                           @continue
                           <div class="col-md-12 card shadow">
                              <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                                 <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                                 <span class="swal2-x-mark-line-right"></span>
                                 </span>
                              </div>
                              <span class="text-center">
                                 <h2>No Books Borrowed</h2>
                              </span>
                           </div>
                           @endif
                           @endforeach
                           @endif
                        </div>
                     </div>
                     <div class="tab-pane" id="step2_2" role="tabpanel">
                        <h3 style="font-size:1.2rem; margin:0 0 1.5rem">Library Clearance Status</h3>
                        <div class="">
                           @if($libclearances->isEmpty())
                           <div class="card shadow">
                              <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                                 <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                                 <span class="swal2-x-mark-line-right"></span>
                                 </span>
                              </div>
                              <span class="text-center">
                                 <h2>Not Cleared</h2>
                              </span>
                           </div>
                           @else
                           @foreach($libclearances as $libclearance)
                           @if($libclearances->contains('email', Auth::User()->email))
                           <div class="card shadow">
                              <div class="card-body">
                                 <div class="dummy-positioning text-center">
                                    <div class="success-icon">
                                       <div class="success-icon__tip"></div>
                                       <div class="success-icon__long"></div>
                                    </div>
                                    &nbsp
                                    <h2>Cleared</h2>
                                 </div>
                              </div>
                           </div>
                           @else
                           <div class="card shadow">
                              <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                                 <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                                 <span class="swal2-x-mark-line-right"></span>
                                 </span>
                              </div>
                              <span class="text-center">
                                 <h2>Not Cleared</h2>
                              </span>
                           </div>
                           @endif
                           @endforeach
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!---------- vertical Tabs End----------------->
         </div>
         <div id="step3" class="tab-pane fade p-0">
            <h3 class="mb-4 text-lg">Finance clarance status</h3>
            <!------vertical Tabs------------->
            <div class="row">
               <div class="col-lg-1 col-md-2 col-sm-2 col-3 vertical-tabs-steps pr-0">
                  <ul class="nav nav-tabs d-flex flex-sm-column border-0" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#step3_1" role="tab" aria-controls="home"><span>Finance Status</span></a>
                     </li>
                  </ul>
               </div>
               <div class="col-lg-11 col-md-10 col-sm-10 col-9 p-0 pl-md-2">
                  <div class="tab-content vertical-tabs-content">
                     <div class="tab-pane active" id="step3_1" role="tabpanel">
                        <h3 style="font-size:1.2rem; margin:0 0 1.5rem">Finance Clearance Status</h3>
                        @if($finclearances->isEmpty())
                        <div class="card shadow">
                           <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                              <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                              <span class="swal2-x-mark-line-right"></span>
                              </span>
                           </div>
                           <span class="text-center">
                              <h2>Not Cleared</h2>
                           </span>
                        </div>
                        @else
                        @foreach($finclearances as $finclearance)
                        @if($finclearances->contains('email', Auth::User()->email))
                        <div class="card shadow">
                           <div class="card-body">
                              <div class="dummy-positioning text-center">
                                 <div class="success-icon">
                                    <div class="success-icon__tip"></div>
                                    <div class="success-icon__long"></div>
                                 </div>
                                 &nbsp
                                 <h2>Cleared</h2>
                              </div>
                           </div>
                        </div>
                        @else
                        <div class="card shadow">
                           <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                              <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                              <span class="swal2-x-mark-line-right"></span>
                              </span>
                           </div>
                           <span class="text-center">
                              <h2>Not Cleared</h2>
                           </span>
                        </div>
                        @endif
                        @endforeach
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            <!---------- vertical Tabs End----------------->
         </div>
         <div id="step4" class="tab-pane fade p-0">
            <h3 class="mb-4">Gown Clearance</h3>
            <!------vertical Tabs------------->
            <div class="row">
               <div class="col-lg-1 col-md-2 col-sm-2 col-3 vertical-tabs-steps pr-0">
                  <ul class="nav nav-tabs d-flex flex-sm-column border-0" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#step4_1" role="tab" aria-controls="home"><span>Select Gown</span></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#step4_2" role="tab" aria-controls="profile"><span>Approval</span></a>
                     </li>
                  </ul>
               </div>
               <div class="col-lg-11 col-md-10 col-sm-10 col-9 p-0 pl-md-2">
                  <div class="tab-content vertical-tabs-content">
                     <div class="tab-pane active" id="step4_1" role="tabpanel">
                        <h3 style="font-size:1.2rem; margin:0 0 1.5rem">Select Gown</h3>
                        <div class="container">
                           <div class="card">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-12 table-responsive">
                                       <table class="table table-bordered table-hover" id="table">
                                          <thead>
                                             <tr>
                                                <th scope="col">Serial Number</th>
                                                <th scope="col">Condition</th>
                                                <th scope="col">Gown Size</th>
                                                <th scope="col-2">Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @if($gowns->count()<=0)
                                             <tr>
                                                <td colspan="11">
                                                   <div class="alert alert-danger">No Record Found</div>
                                                </td>
                                             </tr>
                                             @else
                                             @foreach($gowns as $gown)
                                             @if($emailGown == Auth::User()->email)
                                             <tr>
                                                <td colspan="11">
                                                   <div class="alert alert-info">You already picked a gown</div>
                                                </td>
                                             </tr>
                                             @break
                                             @else
                                             <tr>
                                                <td>{{$gown->gown_serial_number }}</td>
                                                <td>{{$gown->condition }}</td>
                                                <td>{{$gown->size }}</td>
                                                <td scope="col-2">
                                                   <div class="d-flex justify-contents-center">
                                                      <form method="POST" action="{{route('selectGown', $gown->gown_id)}}">
                                                         <input type="hidden" name="email" value="{{Auth::User()->email}}">
                                                         @csrf
                                                         @method('POST')
                                                         <button class="btn btn-danger btn-sm"><i class="fas fa-check"></i><span class="d-none d-lg-inline"> &nbspSelect Gown</span></button>
                                                      </form>
                                                   </div>
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
                        </div>
                     </div>
                     <div class="tab-pane" id="step4_2" role="tabpanel">
                        <h3 style="font-size:1.2rem; margin:0 0 1.5rem">Gown Clearance Status</h3>
                        @if($gownclearances->isEmpty())
                        <div class="card shadow">
                           <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                              <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                              <span class="swal2-x-mark-line-right"></span>
                              </span>
                           </div>
                           <span class="text-center">
                              <h2>Please Select a Gown from the list</h2>
                           </span>
                        </div>
                        @else
                        @foreach($gownclearances as $gownclearance)
                        @if($gownclearance->email == Auth::User()->email)
                        <div class="card shadow">
                           <div class="card-body">
                              <div class="dummy-positioning text-center">
                                 <div class="success-icon">
                                    <div class="success-icon__tip"></div>
                                    <div class="success-icon__long"></div>
                                 </div>
                                 &nbsp
                                 <h2>Picked Gown Serial Number: {{$serialNo}}</h2>
                              </div>
                           </div>
                        </div>
                        @else
                        <div class="card shadow">
                           <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                              <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                              <span class="swal2-x-mark-line-right"></span>
                              </span>
                           </div>
                           <span class="text-center">
                              <h2>Not Cleared</h2>
                           </span>
                        </div>
                        @endif
                        @endforeach
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            <!---------- vertical Tabs End----------------->
         </div>
         <div id="step5" class="tab-pane fade p-0">
            <h3 class="mb-4">Records Clearance</h3>
            <!------vertical Tabs------------->
            <div class="row">
               <div class="col-lg-1 col-md-2 col-sm-2 col-3 vertical-tabs-steps pr-0">
                  <ul class="nav nav-tabs d-flex flex-sm-column border-0" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#step5_1" role="tab" aria-controls="home"><span>Clearance</span></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#step5_2{{$certLock}}" role="tab" aria-controls="profile"><span>Transcripts</span></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#step5_3{{$certLock}}" role="tab" aria-controls="messages"><span>Certificate</span></a>
                     </li>
                  </ul>
               </div>
               <div class="col-lg-11 col-md-10 col-sm-10 col-9 p-0 pl-md-2">
                  <div class="tab-content vertical-tabs-content">
                     <div class="tab-pane active" id="step5_1" role="tabpanel">
                        <h3 style="font-size:1.2rem; margin:0 0 1.5rem">Clearance By Records Officer</h3>
                        @if($certclearances->contains('email', Auth::User()->email))
                        <div class="card shadow">
                           <div class="card-body">
                              <div class="dummy-positioning text-center">
                                 <div class="success-icon">
                                    <div class="success-icon__tip"></div>
                                    <div class="success-icon__long"></div>
                                 </div>
                                 &nbsp
                                 <h2>Cleared</h2>
                              </div>
                           </div>
                        </div>
                        @else
                        <div class="card shadow">
                           <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                              <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                              <span class="swal2-x-mark-line-right"></span>
                              </span>
                           </div>
                           <span class="text-center">
                              <h2>Not Cleared</h2>
                           </span>
                        </div>
                        @endif
                     </div>
                     <div class="tab-pane" id="step5_2" role="tabpanel">
                        <h3 style="font-size:1.2rem; margin:0 0 1.5rem">Transcripts</h3>
                        <div class="col-md-12 mb-4">
                           <div class="container-fluid table-responsive card shadow-sm">
                              <div class="text-center">
                                 <h4 class="mt-4"><i class="fas fa-list"></i>&nbspTranscripts Records</h4>
                              </div>
                              @if($recordDetails->isEmpty())
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
                                    @foreach($recordDetails as $recordDetail)
                                    <tr>
                                       <td>{{ $recordDetail->transcript_serial_number }}</td>
                                       <td>{{ $recordDetail->file_name }}</td>
                                       <td><a href="{{URL::to('/documents/transcripts/'.$recordDetail->file_name )}}" class="btn btn-primary btn-sm"><i class="fas fa-cloud-download"></i> Download</a></td>
                                       <!-- <td scope="col-2"> 
                                          <div class="d-flex justify-contents-center">
                                             <form method="POST" action="">
                                             @csrf
                                                <input type="hidden" name="email" value="{{$recordDetail->email}}">
                                                <button type="submit" class="btn btn-info btn-sm">
                                                   <i class="fas fa-check"></i> <span class="d-none d-lg-inline">Returned</span>
                                                </button>
                                             </form>
                                          </div>
                                          </td> -->
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                              @endif
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" id="step5_3" role="tabpanel">
                        <h3 style="font-size:1.2rem; margin:0 0 1.5rem">Certificate</h3>
                        <div class="col-md-12 mb-4">
                           <div class="container-fluid table-responsive card shadow-sm">
                              <div class="text-center">
                                 <h4 class="mt-4"><i class="fas fa-certificate"></i>&nbspCertificate Record</h4>
                              </div>
                              @if($certificateDetails->isEmpty())
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
                                    @foreach($certificateDetails as $certificateDetail)
                                    <tr>
                                       <td>{{ $certificateDetail->certificate_serial_number }}</td>
                                       <td>{{ $certificateDetail->file_name }}</td>
                                       <td><a href="{{URL::to('/documents/certificates/'.$certificateDetail->file_name )}}" class="btn btn-primary btn-sm"><i class="fas fa-cloud-download"></i> Download</a></td>
                                       <!-- <td scope="col-2"> 
                                          <div class="d-flex justify-contents-center">
                                             <form method="POST" action="">
                                             @csrf
                                                <input type="hidden" name="email" value="{{$certificateDetail->email}}">
                                                <button type="submit" class="btn btn-info btn-sm">
                                                   <i class="fas fa-check"></i> <span class="d-none d-lg-inline">Returned</span>
                                                </button>
                                             </form>
                                          </div>
                                          </td> -->
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!---------- vertical Tabs End----------------->
         </div>
      </div>
   </div>
   <!---------------Platform Tour End----------------->
</div>
@endif
@endforeach
<style>
   .dummy-positioning {
   -webkit-box-align: center;
   align-items: center;
   -webkit-box-pack: center;
   justify-content: center;
   }
   .success-icon {
   display: inline-block;
   width:4em;
   height:4em;
   font-size: 20px;
   border-radius: 50%;
   border: 4px solid #96df8f;
   background-color: #fff;
   position: relative;
   overflow: hidden;
   -webkit-transform-origin: center;
   transform-origin: center;
   -webkit-animation: showSuccess 180ms ease-in-out;
   animation: showSuccess 180ms ease-in-out;
   -webkit-transform: scale(1);
   transform: scale(1);
   }
   .success-icon__tip, .success-icon__long {
   display: block;
   position: absolute;
   height: 4px;
   background-color: #96df8f;
   border-radius: 10px;
   }
   .success-icon__tip {
   width: 2.4em;
   top:2.15em;
   left: 1.4em;
   -webkit-transform: rotate(45deg);
   transform: rotate(45deg);
   -webkit-animation: tipInPlace 300ms ease-in-out;
   animation: tipInPlace 300ms ease-in-out;
   -webkit-animation-fill-mode: forwards;
   animation-fill-mode: forwards;
   -webkit-animation-delay: 180ms;
   animation-delay: 180ms;
   visibility: hidden;
   }
   .success-icon__long {
   width: 4em;
   -webkit-transform: rotate(-45deg);
   transform: rotate(-45deg);
   top: 1.85em;
   left: 2.75em;
   -webkit-animation: longInPlace 140ms ease-in-out;
   animation: longInPlace 140ms ease-in-out;
   -webkit-animation-fill-mode: forwards;
   animation-fill-mode: forwards;
   visibility: hidden;
   -webkit-animation-delay: 440ms;
   animation-delay: 440ms;
   }
   @-webkit-keyframes showSuccess {
   from {
   -webkit-transform: scale(0);
   transform: scale(0);
   }
   to {
   -webkit-transform: scale(1);
   transform: scale(1);
   }
   }
   @keyframes showSuccess {
   from {
   -webkit-transform: scale(0);
   transform: scale(0);
   }
   to {
   -webkit-transform: scale(1);
   transform: scale(1);
   }
   }
   @-webkit-keyframes tipInPlace {
   from {
   width: 0em;
   top: 0em;
   left: -0.8em;
   }
   to {
   width:1.2em;
   top: 2.15em;
   left: 0.7em;
   visibility: visible;
   }
   }
   @keyframes tipInPlace {
   from {
   width: 0em;
   top: 0em;
   left: -0.8em;
   }
   to {
   width:1.2em;
   top: 2.15em;
   left:0.7em;
   visibility: visible;
   }
   }
   @-webkit-keyframes longInPlace {
   from {
   width: 0em;
   top: 2.55em;
   left:1.6em;
   }
   to {
   width: 2em;
   top: 1.85em;
   left: 1.375em;
   visibility: visible;
   }
   }
   @keyframes longInPlace {
   from {
   width: 0em;
   top: 2.55em;
   left: 1.6em;
   }
   to {
   width: 2em;
   top: 1.85em;
   left: 1.375em;
   visibility: visible;
   }
   }
   @-webkit-keyframes swal2-show{
   0%{
   -webkit-transform:scale(.7);
   transform:scale(.7)
   }
   45%{
   -webkit-transform:scale(1.05);
   transform:scale(1.05)
   }
   80%{
   -webkit-transform:scale(.95);
   transform:scale(.95)
   }
   100%{
   -webkit-transform:scale(1);
   transform:scale(1)
   }
   }
   @keyframes swal2-show{
   0%{
   -webkit-transform:scale(.7);
   transform:scale(.7)
   }
   45%{
   -webkit-transform:scale(1.05);
   transform:scale(1.05)
   }
   80%{
   -webkit-transform:scale(.95);
   transform:scale(.95)
   }
   100%{
   -webkit-transform:scale(1);
   transform:scale(1)
   }
   }
   @-webkit-keyframes swal2-hide{
   0%{
   -webkit-transform:scale(1);
   transform:scale(1);
   opacity:1
   }
   100%{
   -webkit-transform:scale(.5);
   transform:scale(.5);
   opacity:0
   }
   }
   @keyframes swal2-hide{
   0%{
   -webkit-transform:scale(1);
   transform:scale(1);
   opacity:1
   }
   100%{
   -webkit-transform:scale(.5);
   transform:scale(.5);
   opacity:0
   }
   }
   @-webkit-keyframes swal2-animate-success-line-tip{
   0%{
   top:1.1875em;
   left:.0625em;
   width:0
   }
   54%{
   top:1.0625em;
   left:.125em;
   width:0
   }
   70%{
   top:2.1875em;
   left:-.375em;
   width:3.125em
   }
   84%{
   top:3em;
   left:1.3125em;
   width:1.0625em
   }
   100%{
   top:2.8125em;
   left:.875em;
   width:1.5625em
   }
   }
   @keyframes swal2-animate-success-line-tip{
   0%{
   top:1.1875em;
   left:.0625em;
   width:0
   }
   54%{
   top:1.0625em;
   left:.125em;
   width:0
   }
   70%{
   top:2.1875em;
   left:-.375em;
   width:3.125em
   }
   84%{
   top:3em;
   left:1.3125em;
   width:1.0625em
   }
   100%{
   top:2.8125em;
   left:.875em;
   width:1.5625em
   }
   }
   @-webkit-keyframes swal2-animate-success-line-long{
   0%{
   top:3.375em;
   right:2.875em;
   width:0
   }
   65%{
   top:3.375em;
   right:2.875em;
   width:0
   }
   84%{
   top:2.1875em;
   right:0;
   width:3.4375em
   }
   100%{
   top:2.375em;
   right:.5em;
   width:2.9375em
   }
   }
   @keyframes swal2-animate-success-line-long{
   0%{
   top:3.375em;
   right:2.875em;
   width:0
   }
   65%{
   top:3.375em;
   right:2.875em;
   width:0
   }
   84%{
   top:2.1875em;
   right:0;
   width:3.4375em
   }
   100%{
   top:2.375em;
   right:.5em;
   width:2.9375em
   }
   }
   @-webkit-keyframes swal2-rotate-success-circular-line{
   0%{
   -webkit-transform:rotate(-45deg);
   transform:rotate(-45deg)
   }
   5%{
   -webkit-transform:rotate(-45deg);
   transform:rotate(-45deg)
   }
   12%{
   -webkit-transform:rotate(-405deg);
   transform:rotate(-405deg)
   }
   100%{
   -webkit-transform:rotate(-405deg);
   transform:rotate(-405deg)
   }
   }
   @keyframes swal2-rotate-success-circular-line{
   0%{
   -webkit-transform:rotate(-45deg);
   transform:rotate(-45deg)
   }
   5%{
   -webkit-transform:rotate(-45deg);
   transform:rotate(-45deg)
   }
   12%{
   -webkit-transform:rotate(-405deg);
   transform:rotate(-405deg)
   }
   100%{
   -webkit-transform:rotate(-405deg);
   transform:rotate(-405deg)
   }
   }
   @-webkit-keyframes swal2-animate-error-x-mark{
   0%{
   margin-top:1.625em;
   -webkit-transform:scale(.4);
   transform:scale(.4);
   opacity:0
   }
   50%{
   margin-top:1.625em;
   -webkit-transform:scale(.4);
   transform:scale(.4);
   opacity:0
   }
   80%{
   margin-top:-.375em;
   -webkit-transform:scale(1.15);
   transform:scale(1.15)
   }
   100%{
   margin-top:0;
   -webkit-transform:scale(1);
   transform:scale(1);
   opacity:1
   }
   }
   @keyframes swal2-animate-error-x-mark{
   0%{
   margin-top:1.625em;
   -webkit-transform:scale(.4);
   transform:scale(.4);
   opacity:0
   }
   50%{
   margin-top:1.625em;
   -webkit-transform:scale(.4);
   transform:scale(.4);
   opacity:0
   }
   80%{
   margin-top:-.375em;
   -webkit-transform:scale(1.15);
   transform:scale(1.15)
   }
   100%{
   margin-top:0;
   -webkit-transform:scale(1);
   transform:scale(1);
   opacity:1
   }
   }
   @-webkit-keyframes swal2-animate-error-icon{
   0%{
   -webkit-transform:rotateX(100deg);
   transform:rotateX(100deg);
   opacity:0
   }
   100%{
   -webkit-transform:rotateX(0);
   transform:rotateX(0);
   opacity:1
   }
   }
   @keyframes swal2-animate-error-icon{
   0%{
   -webkit-transform:rotateX(100deg);
   transform:rotateX(100deg);
   opacity:0
   }
   100%{
   -webkit-transform:rotateX(0);
   transform:rotateX(0);
   opacity:1
   }
   }
   body.swal2-toast-shown.swal2-has-input>.swal2-container>.swal2-toast{
   flex-direction:column;
   align-items:stretch
   }
   body.swal2-toast-shown.swal2-has-input>.swal2-container>.swal2-toast .swal2-actions{
   flex:1;
   align-self:stretch;
   justify-content:flex-end;
   height:2.2em
   }
   body.swal2-toast-shown.swal2-has-input>.swal2-container>.swal2-toast .swal2-loading{
   justify-content:center
   }
   body.swal2-toast-shown.swal2-has-input>.swal2-container>.swal2-toast .swal2-input{
   height:2em;
   margin:.3125em auto;
   font-size:1em
   }
   body.swal2-toast-shown.swal2-has-input>.swal2-container>.swal2-toast .swal2-validationerror{
   font-size:1em
   }
   body.swal2-toast-shown>.swal2-container{
   position:fixed;
   background-color:transparent
   }
   body.swal2-toast-shown>.swal2-container.swal2-shown{
   background-color:transparent
   }
   body.swal2-toast-shown>.swal2-container.swal2-top{
   top:0;
   right:auto;
   bottom:auto;
   left:50%;
   -webkit-transform:translateX(-50%);
   transform:translateX(-50%)
   }
   body.swal2-toast-shown>.swal2-container.swal2-top-end,body.swal2-toast-shown>.swal2-container.swal2-top-right{
   top:0;
   right:0;
   bottom:auto;
   left:auto
   }
   body.swal2-toast-shown>.swal2-container.swal2-top-left,body.swal2-toast-shown>.swal2-container.swal2-top-start{
   top:0;
   right:auto;
   bottom:auto;
   left:0
   }
   body.swal2-toast-shown>.swal2-container.swal2-center-left,body.swal2-toast-shown>.swal2-container.swal2-center-start{
   top:50%;
   right:auto;
   bottom:auto;
   left:0;
   -webkit-transform:translateY(-50%);
   transform:translateY(-50%)
   }
   body.swal2-toast-shown>.swal2-container.swal2-center{
   top:50%;
   right:auto;
   bottom:auto;
   left:50%;
   -webkit-transform:translate(-50%,-50%);
   transform:translate(-50%,-50%)
   }
   body.swal2-toast-shown>.swal2-container.swal2-center-end,body.swal2-toast-shown>.swal2-container.swal2-center-right{
   top:50%;
   right:0;
   bottom:auto;
   left:auto;
   -webkit-transform:translateY(-50%);
   transform:translateY(-50%)
   }
   body.swal2-toast-shown>.swal2-container.swal2-bottom-left,body.swal2-toast-shown>.swal2-container.swal2-bottom-start{
   top:auto;
   right:auto;
   bottom:0;
   left:0
   }
   body.swal2-toast-shown>.swal2-container.swal2-bottom{
   top:auto;
   right:auto;
   bottom:0;
   left:50%;
   -webkit-transform:translateX(-50%);
   transform:translateX(-50%)
   }
   body.swal2-toast-shown>.swal2-container.swal2-bottom-end,body.swal2-toast-shown>.swal2-container.swal2-bottom-right{
   top:auto;
   right:0;
   bottom:0;
   left:auto
   }
   .swal2-popup.swal2-toast{
   flex-direction:row;
   align-items:center;
   width:auto;
   padding:.625em;
   box-shadow:0 0 .625em #d9d9d9;
   overflow-y:hidden
   }
   .swal2-popup.swal2-toast .swal2-header{
   flex-direction:row
   }
   .swal2-popup.swal2-toast .swal2-title{
   justify-content:flex-start;
   margin:0 .6em;
   font-size:1em
   }
   .swal2-popup.swal2-toast .swal2-close{
   position:initial
   }
   .swal2-popup.swal2-toast .swal2-content{
   justify-content:flex-start;
   font-size:1em
   }
   .swal2-popup.swal2-toast .swal2-icon{
   width:2em;
   min-width:2em;
   height:2em;
   margin:0
   }
   .swal2-popup.swal2-toast .swal2-icon-text{
   font-size:2em;
   font-weight:700;
   line-height:1em
   }
   .swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring{
   width:2em;
   height:2em
   }
   .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line]{
   top:.875em;
   width:1.375em
   }
   .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{
   left:.3125em
   }
   .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{
   right:.3125em
   }
   .swal2-popup.swal2-toast .swal2-actions{
   height:auto;
   margin:0 .3125em
   }
   .swal2-popup.swal2-toast .swal2-styled{
   margin:0 .3125em;
   padding:.3125em .625em;
   font-size:1em
   }
   .swal2-popup.swal2-toast .swal2-styled:focus{
   box-shadow:0 0 0 .0625em #fff,0 0 0 .125em rgba(50,100,150,.4)
   }
   .swal2-popup.swal2-toast .swal2-success{
   border-color:#a5dc86
   }
   .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line]{
   position:absolute;
   width:2em;
   height:2.8125em;
   -webkit-transform:rotate(45deg);
   transform:rotate(45deg);
   border-radius:50%
   }
   .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left]{
   top:-.25em;
   left:-.9375em;
   -webkit-transform:rotate(-45deg);
   transform:rotate(-45deg);
   -webkit-transform-origin:2em 2em;
   transform-origin:2em 2em;
   border-radius:4em 0 0 4em
   }
   .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right]{
   top:-.25em;
   left:.9375em;
   -webkit-transform-origin:0 2em;
   transform-origin:0 2em;
   border-radius:0 4em 4em 0
   }
   .swal2-popup.swal2-toast .swal2-success .swal2-success-ring{
   width:2em;
   height:2em
   }
   .swal2-popup.swal2-toast .swal2-success .swal2-success-fix{
   top:0;
   left:.4375em;
   width:.4375em;
   height:2.6875em
   }
   .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line]{
   height:.3125em
   }
   .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip]{
   top:1.125em;
   left:.1875em;
   width:.75em
   }
   .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long]{
   top:.9375em;
   right:.1875em;
   width:1.375em
   }
   .swal2-popup.swal2-toast.swal2-show{
   -webkit-animation:showSweetToast .5s;
   animation:showSweetToast .5s
   }
   .swal2-popup.swal2-toast.swal2-hide{
   -webkit-animation:hideSweetToast .2s forwards;
   animation:hideSweetToast .2s forwards
   }
   .swal2-popup.swal2-toast .swal2-animate-success-icon .swal2-success-line-tip{
   -webkit-animation:animate-toast-success-tip .75s;
   animation:animate-toast-success-tip .75s
   }
   .swal2-popup.swal2-toast .swal2-animate-success-icon .swal2-success-line-long{
   -webkit-animation:animate-toast-success-long .75s;
   animation:animate-toast-success-long .75s
   }
   @-webkit-keyframes showSweetToast{
   0%{
   -webkit-transform:translateY(-.625em) rotateZ(2deg);
   transform:translateY(-.625em) rotateZ(2deg);
   opacity:0
   }
   33%{
   -webkit-transform:translateY(0) rotateZ(-2deg);
   transform:translateY(0) rotateZ(-2deg);
   opacity:.5
   }
   66%{
   -webkit-transform:translateY(.3125em) rotateZ(2deg);
   transform:translateY(.3125em) rotateZ(2deg);
   opacity:.7
   }
   100%{
   -webkit-transform:translateY(0) rotateZ(0);
   transform:translateY(0) rotateZ(0);
   opacity:1
   }
   }
   @keyframes showSweetToast{
   0%{
   -webkit-transform:translateY(-.625em) rotateZ(2deg);
   transform:translateY(-.625em) rotateZ(2deg);
   opacity:0
   }
   33%{
   -webkit-transform:translateY(0) rotateZ(-2deg);
   transform:translateY(0) rotateZ(-2deg);
   opacity:.5
   }
   66%{
   -webkit-transform:translateY(.3125em) rotateZ(2deg);
   transform:translateY(.3125em) rotateZ(2deg);
   opacity:.7
   }
   100%{
   -webkit-transform:translateY(0) rotateZ(0);
   transform:translateY(0) rotateZ(0);
   opacity:1
   }
   }
   @-webkit-keyframes hideSweetToast{
   0%{
   opacity:1
   }
   33%{
   opacity:.5
   }
   100%{
   -webkit-transform:rotateZ(1deg);
   transform:rotateZ(1deg);
   opacity:0
   }
   }
   @keyframes hideSweetToast{
   0%{
   opacity:1
   }
   33%{
   opacity:.5
   }
   100%{
   -webkit-transform:rotateZ(1deg);
   transform:rotateZ(1deg);
   opacity:0
   }
   }
   @-webkit-keyframes animate-toast-success-tip{
   0%{
   top:.5625em;
   left:.0625em;
   width:0
   }
   54%{
   top:.125em;
   left:.125em;
   width:0
   }
   70%{
   top:.625em;
   left:-.25em;
   width:1.625em
   }
   84%{
   top:1.0625em;
   left:.75em;
   width:.5em
   }
   100%{
   top:1.125em;
   left:.1875em;
   width:.75em
   }
   }
   @keyframes animate-toast-success-tip{
   0%{
   top:.5625em;
   left:.0625em;
   width:0
   }
   54%{
   top:.125em;
   left:.125em;
   width:0
   }
   70%{
   top:.625em;
   left:-.25em;
   width:1.625em
   }
   84%{
   top:1.0625em;
   left:.75em;
   width:.5em
   }
   100%{
   top:1.125em;
   left:.1875em;
   width:.75em
   }
   }
   @-webkit-keyframes animate-toast-success-long{
   0%{
   top:1.625em;
   right:1.375em;
   width:0
   }
   65%{
   top:1.25em;
   right:.9375em;
   width:0
   }
   84%{
   top:.9375em;
   right:0;
   width:1.125em
   }
   100%{
   top:.9375em;
   right:.1875em;
   width:1.375em
   }
   }
   @keyframes animate-toast-success-long{
   0%{
   top:1.625em;
   right:1.375em;
   width:0
   }
   65%{
   top:1.25em;
   right:.9375em;
   width:0
   }
   84%{
   top:.9375em;
   right:0;
   width:1.125em
   }
   100%{
   top:.9375em;
   right:.1875em;
   width:1.375em
   }
   }
   body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){
   overflow-y:hidden
   }
   body.swal2-height-auto{
   height:auto!important
   }
   body.swal2-no-backdrop .swal2-shown{
   top:auto;
   right:auto;
   bottom:auto;
   left:auto;
   background-color:transparent
   }
   body.swal2-no-backdrop .swal2-shown>.swal2-modal{
   box-shadow:0 0 10px rgba(0,0,0,.4)
   }
   body.swal2-no-backdrop .swal2-shown.swal2-top{
   top:0;
   left:50%;
   -webkit-transform:translateX(-50%);
   transform:translateX(-50%)
   }
   body.swal2-no-backdrop .swal2-shown.swal2-top-left,body.swal2-no-backdrop .swal2-shown.swal2-top-start{
   top:0;
   left:0
   }
   body.swal2-no-backdrop .swal2-shown.swal2-top-end,body.swal2-no-backdrop .swal2-shown.swal2-top-right{
   top:0;
   right:0
   }
   body.swal2-no-backdrop .swal2-shown.swal2-center{
   top:50%;
   left:50%;
   -webkit-transform:translate(-50%,-50%);
   transform:translate(-50%,-50%)
   }
   body.swal2-no-backdrop .swal2-shown.swal2-center-left,body.swal2-no-backdrop .swal2-shown.swal2-center-start{
   top:50%;
   left:0;
   -webkit-transform:translateY(-50%);
   transform:translateY(-50%)
   }
   body.swal2-no-backdrop .swal2-shown.swal2-center-end,body.swal2-no-backdrop .swal2-shown.swal2-center-right{
   top:50%;
   right:0;
   -webkit-transform:translateY(-50%);
   transform:translateY(-50%)
   }
   body.swal2-no-backdrop .swal2-shown.swal2-bottom{
   bottom:0;
   left:50%;
   -webkit-transform:translateX(-50%);
   transform:translateX(-50%)
   }
   body.swal2-no-backdrop .swal2-shown.swal2-bottom-left,body.swal2-no-backdrop .swal2-shown.swal2-bottom-start{
   bottom:0;
   left:0
   }
   body.swal2-no-backdrop .swal2-shown.swal2-bottom-end,body.swal2-no-backdrop .swal2-shown.swal2-bottom-right{
   right:0;
   bottom:0
   }
   .swal2-container{
   display:flex;
   position:fixed;
   top:0;
   right:0;
   bottom:0;
   left:0;
   flex-direction:row;
   align-items:center;
   justify-content:center;
   padding:10px;
   background-color:transparent;
   z-index:1060;
   overflow-x:hidden;
   -webkit-overflow-scrolling:touch
   }
   .swal2-container.swal2-top{
   align-items:flex-start
   }
   .swal2-container.swal2-top-left,.swal2-container.swal2-top-start{
   align-items:flex-start;
   justify-content:flex-start
   }
   .swal2-container.swal2-top-end,.swal2-container.swal2-top-right{
   align-items:flex-start;
   justify-content:flex-end
   }
   .swal2-container.swal2-center{
   align-items:center
   }
   .swal2-container.swal2-center-left,.swal2-container.swal2-center-start{
   align-items:center;
   justify-content:flex-start
   }
   .swal2-container.swal2-center-end,.swal2-container.swal2-center-right{
   align-items:center;
   justify-content:flex-end
   }
   .swal2-container.swal2-bottom{
   align-items:flex-end
   }
   .swal2-container.swal2-bottom-left,.swal2-container.swal2-bottom-start{
   align-items:flex-end;
   justify-content:flex-start
   }
   .swal2-container.swal2-bottom-end,.swal2-container.swal2-bottom-right{
   align-items:flex-end;
   justify-content:flex-end
   }
   .swal2-container.swal2-grow-fullscreen>.swal2-modal{
   display:flex!important;
   flex:1;
   align-self:stretch;
   justify-content:center
   }
   .swal2-container.swal2-grow-row>.swal2-modal{
   display:flex!important;
   flex:1;
   align-content:center;
   justify-content:center
   }
   .swal2-container.swal2-grow-column{
   flex:1;
   flex-direction:column
   }
   .swal2-container.swal2-grow-column.swal2-bottom,.swal2-container.swal2-grow-column.swal2-center,.swal2-container.swal2-grow-column.swal2-top{
   align-items:center
   }
   .swal2-container.swal2-grow-column.swal2-bottom-left,.swal2-container.swal2-grow-column.swal2-bottom-start,.swal2-container.swal2-grow-column.swal2-center-left,.swal2-container.swal2-grow-column.swal2-center-start,.swal2-container.swal2-grow-column.swal2-top-left,.swal2-container.swal2-grow-column.swal2-top-start{
   align-items:flex-start
   }
   .swal2-container.swal2-grow-column.swal2-bottom-end,.swal2-container.swal2-grow-column.swal2-bottom-right,.swal2-container.swal2-grow-column.swal2-center-end,.swal2-container.swal2-grow-column.swal2-center-right,.swal2-container.swal2-grow-column.swal2-top-end,.swal2-container.swal2-grow-column.swal2-top-right{
   align-items:flex-end
   }
   .swal2-container.swal2-grow-column>.swal2-modal{
   display:flex!important;
   flex:1;
   align-content:center;
   justify-content:center
   }
   .swal2-container:not(.swal2-top):not(.swal2-top-start):not(.swal2-top-end):not(.swal2-top-left):not(.swal2-top-right):not(.swal2-center-start):not(.swal2-center-end):not(.swal2-center-left):not(.swal2-center-right):not(.swal2-bottom):not(.swal2-bottom-start):not(.swal2-bottom-end):not(.swal2-bottom-left):not(.swal2-bottom-right)>.swal2-modal{
   margin:auto
   }
   @media all and (-ms-high-contrast:none),(-ms-high-contrast:active){
   .swal2-container .swal2-modal{
   margin:0!important
   }
   }
   .swal2-container.swal2-fade{
   transition:background-color .1s
   }
   .swal2-container.swal2-shown{
   background-color:rgba(0,0,0,.4)
   }
   .swal2-popup{
   display:none;
   position:relative;
   flex-direction:column;
   justify-content:center;
   width:32em;
   max-width:100%;
   padding:1.25em;
   border-radius:.3125em;
   background:#fff;
   font-family:inherit;
   font-size:1rem;
   box-sizing:border-box
   }
   .swal2-popup:focus{
   outline:0
   }
   .swal2-popup.swal2-loading{
   overflow-y:hidden
   }
   .swal2-popup .swal2-header{
   display:flex;
   flex-direction:column;
   align-items:center
   }
   .swal2-popup .swal2-title{
   display:block;
   position:relative;
   max-width:100%;
   margin:0 0 .4em;
   padding:0;
   color:#595959;
   font-size:1.875em;
   font-weight:600;
   text-align:center;
   text-transform:none;
   word-wrap:break-word
   }
   .swal2-popup .swal2-actions{
   align-items:center;
   justify-content:center;
   margin:1.25em auto 0
   }
   .swal2-popup .swal2-actions:not(.swal2-loading) .swal2-styled[disabled]{
   opacity:.4
   }
   .swal2-popup .swal2-actions:not(.swal2-loading) .swal2-styled:hover{
   background-image:linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.1))
   }
   .swal2-popup .swal2-actions:not(.swal2-loading) .swal2-styled:active{
   background-image:linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.2))
   }
   .swal2-popup .swal2-actions.swal2-loading .swal2-styled.swal2-confirm{
   width:2.5em;
   height:2.5em;
   margin:.46875em;
   padding:0;
   border:.25em solid transparent;
   border-radius:100%;
   border-color:transparent;
   background-color:transparent!important;
   color:transparent;
   cursor:default;
   box-sizing:border-box;
   -webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;
   animation:swal2-rotate-loading 1.5s linear 0s infinite normal;
   -webkit-user-select:none;
   -moz-user-select:none;
   -ms-user-select:none;
   user-select:none
   }
   .swal2-popup .swal2-actions.swal2-loading .swal2-styled.swal2-cancel{
   margin-right:30px;
   margin-left:30px
   }
   .swal2-popup .swal2-actions.swal2-loading :not(.swal2-styled).swal2-confirm::after{
   display:inline-block;
   width:15px;
   height:15px;
   margin-left:5px;
   border:3px solid #999;
   border-radius:50%;
   border-right-color:transparent;
   box-shadow:1px 1px 1px #fff;
   content:'';
   -webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;
   animation:swal2-rotate-loading 1.5s linear 0s infinite normal
   }
   .swal2-popup .swal2-styled{
   margin:0 .3125em;
   padding:.625em 2em;
   font-weight:500;
   box-shadow:none
   }
   .swal2-popup .swal2-styled:not([disabled]){
   cursor:pointer
   }
   .swal2-popup .swal2-styled.swal2-confirm{
   border:0;
   border-radius:.25em;
   background:initial;
   background-color:#3085d6;
   color:#fff;
   font-size:1.0625em
   }
   .swal2-popup .swal2-styled.swal2-cancel{
   border:0;
   border-radius:.25em;
   background:initial;
   background-color:#aaa;
   color:#fff;
   font-size:1.0625em
   }
   .swal2-popup .swal2-styled:focus{
   outline:0;
   box-shadow:0 0 0 2px #fff,0 0 0 4px rgba(50,100,150,.4)
   }
   .swal2-popup .swal2-styled::-moz-focus-inner{
   border:0
   }
   .swal2-popup .swal2-footer{
   justify-content:center;
   margin:1.25em 0 0;
   padding-top:1em;
   border-top:1px solid #eee;
   color:#545454;
   font-size:1em
   }
   .swal2-popup .swal2-image{
   max-width:100%;
   margin:1.25em auto
   }
   .swal2-popup .swal2-close{
   position:absolute;
   top:0;
   right:0;
   justify-content:center;
   width:1.2em;
   height:1.2em;
   padding:0;
   transition:color .1s ease-out;
   border:none;
   border-radius:0;
   background:0 0;
   color:#ccc;
   font-family:serif;
   font-size:2.5em;
   line-height:1.2;
   cursor:pointer;
   overflow:hidden
   }
   .swal2-popup .swal2-close:hover{
   -webkit-transform:none;
   transform:none;
   color:#f27474
   }
   .swal2-popup>.swal2-checkbox,.swal2-popup>.swal2-file,.swal2-popup>.swal2-input,.swal2-popup>.swal2-radio,.swal2-popup>.swal2-select,.swal2-popup>.swal2-textarea{
   display:none
   }
   .swal2-popup .swal2-content{
   justify-content:center;
   margin:0;
   padding:0;
   color:#545454;
   font-size:1.125em;
   font-weight:300;
   line-height:normal;
   word-wrap:break-word
   }
   .swal2-popup #swal2-content{
   text-align:center
   }
   .swal2-popup .swal2-checkbox,.swal2-popup .swal2-file,.swal2-popup .swal2-input,.swal2-popup .swal2-radio,.swal2-popup .swal2-select,.swal2-popup .swal2-textarea{
   margin:1em auto
   }
   .swal2-popup .swal2-file,.swal2-popup .swal2-input,.swal2-popup .swal2-textarea{
   width:100%;
   transition:border-color .3s,box-shadow .3s;
   border:1px solid #d9d9d9;
   border-radius:.1875em;
   font-size:1.125em;
   box-shadow:inset 0 1px 1px rgba(0,0,0,.06);
   box-sizing:border-box
   }
   .swal2-popup .swal2-file.swal2-inputerror,.swal2-popup .swal2-input.swal2-inputerror,.swal2-popup .swal2-textarea.swal2-inputerror{
   border-color:#f27474!important;
   box-shadow:0 0 2px #f27474!important
   }
   .swal2-popup .swal2-file:focus,.swal2-popup .swal2-input:focus,.swal2-popup .swal2-textarea:focus{
   border:1px solid #b4dbed;
   outline:0;
   box-shadow:0 0 3px #c4e6f5
   }
   .swal2-popup .swal2-file::-webkit-input-placeholder,.swal2-popup .swal2-input::-webkit-input-placeholder,.swal2-popup .swal2-textarea::-webkit-input-placeholder{
   color:#ccc
   }
   .swal2-popup .swal2-file:-ms-input-placeholder,.swal2-popup .swal2-input:-ms-input-placeholder,.swal2-popup .swal2-textarea:-ms-input-placeholder{
   color:#ccc
   }
   .swal2-popup .swal2-file::-ms-input-placeholder,.swal2-popup .swal2-input::-ms-input-placeholder,.swal2-popup .swal2-textarea::-ms-input-placeholder{
   color:#ccc
   }
   .swal2-popup .swal2-file::placeholder,.swal2-popup .swal2-input::placeholder,.swal2-popup .swal2-textarea::placeholder{
   color:#ccc
   }
   .swal2-popup .swal2-range input{
   width:80%
   }
   .swal2-popup .swal2-range output{
   width:20%;
   font-weight:600;
   text-align:center
   }
   .swal2-popup .swal2-range input,.swal2-popup .swal2-range output{
   height:2.625em;
   margin:1em auto;
   padding:0;
   font-size:1.125em;
   line-height:2.625em
   }
   .swal2-popup .swal2-input{
   height:2.625em;
   padding:.75em
   }
   .swal2-popup .swal2-input[type=number]{
   max-width:10em
   }
   .swal2-popup .swal2-file{
   font-size:1.125em
   }
   .swal2-popup .swal2-textarea{
   height:6.75em;
   padding:.75em
   }
   .swal2-popup .swal2-select{
   min-width:50%;
   max-width:100%;
   padding:.375em .625em;
   color:#545454;
   font-size:1.125em
   }
   .swal2-popup .swal2-checkbox,.swal2-popup .swal2-radio{
   align-items:center;
   justify-content:center
   }
   .swal2-popup .swal2-checkbox label,.swal2-popup .swal2-radio label{
   margin:0 .6em;
   font-size:1.125em
   }
   .swal2-popup .swal2-checkbox input,.swal2-popup .swal2-radio input{
   margin:0 .4em
   }
   .swal2-popup .swal2-validationerror{
   display:none;
   align-items:center;
   justify-content:center;
   padding:.625em;
   background:#f0f0f0;
   color:#666;
   font-size:1em;
   font-weight:300;
   overflow:hidden
   }
   .swal2-popup .swal2-validationerror::before{
   display:inline-block;
   width:1.5em;
   min-width:1.5em;
   height:1.5em;
   margin:0 .625em;
   border-radius:50%;
   background-color:#f27474;
   color:#fff;
   font-weight:600;
   line-height:1.5em;
   text-align:center;
   content:'!';
   zoom:normal
   }
   @supports (-ms-accelerator:true){
   .swal2-range input{
   width:100%!important
   }
   .swal2-range output{
   display:none
   }
   }
   @media all and (-ms-high-contrast:none),(-ms-high-contrast:active){
   .swal2-range input{
   width:100%!important
   }
   .swal2-range output{
   display:none
   }
   }
   @-moz-document url-prefix(){
   .swal2-close:focus{
   outline:2px solid rgba(50,100,150,.4)
   }
   }
   .swal2-icon{
   position:relative;
   justify-content:center;
   width:5em;
   height:5em;
   margin:1.25em auto 1.875em;
   border:.25em solid transparent;
   border-radius:50%;
   line-height:5em;
   cursor:default;
   box-sizing:content-box;
   -webkit-user-select:none;
   -moz-user-select:none;
   -ms-user-select:none;
   user-select:none;
   zoom:normal
   }
   .swal2-icon-text{
   font-size:3.75em
   }
   .swal2-icon.swal2-error{
   border-color:#f27474
   }
   .swal2-icon.swal2-error .swal2-x-mark{
   position:relative;
   flex-grow:1
   }
   .swal2-icon.swal2-error [class^=swal2-x-mark-line]{
   display:block;
   position:absolute;
   top:2.3125em;
   width:2.9375em;
   height:.3125em;
   border-radius:.125em;
   background-color:#f27474
   }
   .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{
   left:1.0625em;
   -webkit-transform:rotate(45deg);
   transform:rotate(45deg)
   }
   .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{
   right:1em;
   -webkit-transform:rotate(-45deg);
   transform:rotate(-45deg)
   }
   .swal2-icon.swal2-warning{
   border-color:#facea8;
   color:#f8bb86
   }
   .swal2-icon.swal2-info{
   border-color:#9de0f6;
   color:#3fc3ee
   }
   .swal2-icon.swal2-question{
   border-color:#c9dae1;
   color:#87adbd
   }
   .swal2-icon.swal2-success{
   border-color:#a5dc86
   }
   .swal2-icon.swal2-success [class^=swal2-success-circular-line]{
   position:absolute;
   width:3.75em;
   height:7.5em;
   -webkit-transform:rotate(45deg);
   transform:rotate(45deg);
   border-radius:50%
   }
   .swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=left]{
   top:-.4375em;
   left:-2.0635em;
   -webkit-transform:rotate(-45deg);
   transform:rotate(-45deg);
   -webkit-transform-origin:3.75em 3.75em;
   transform-origin:3.75em 3.75em;
   border-radius:7.5em 0 0 7.5em
   }
   .swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=right]{
   top:-.6875em;
   left:1.875em;
   -webkit-transform:rotate(-45deg);
   transform:rotate(-45deg);
   -webkit-transform-origin:0 3.75em;
   transform-origin:0 3.75em;
   border-radius:0 7.5em 7.5em 0
   }
   .swal2-icon.swal2-success .swal2-success-ring{
   position:absolute;
   top:-.25em;
   left:-.25em;
   width:100%;
   height:100%;
   border:.25em solid rgba(165,220,134,.3);
   border-radius:50%;
   z-index:2;
   box-sizing:content-box
   }
   .swal2-icon.swal2-success .swal2-success-fix{
   position:absolute;
   top:.5em;
   left:1.625em;
   width:.4375em;
   height:5.625em;
   -webkit-transform:rotate(-45deg);
   transform:rotate(-45deg);
   z-index:1
   }
   .swal2-icon.swal2-success [class^=swal2-success-line]{
   display:block;
   position:absolute;
   height:.3125em;
   border-radius:.125em;
   background-color:#a5dc86;
   z-index:2
   }
   .swal2-icon.swal2-success [class^=swal2-success-line][class$=tip]{
   top:2.875em;
   left:.875em;
   width:1.5625em;
   -webkit-transform:rotate(45deg);
   transform:rotate(45deg)
   }
   .swal2-icon.swal2-success [class^=swal2-success-line][class$=long]{
   top:2.375em;
   right:.5em;
   width:2.9375em;
   -webkit-transform:rotate(-45deg);
   transform:rotate(-45deg)
   }
   .swal2-progresssteps{
   align-items:center;
   margin:0 0 1.25em;
   padding:0;
   font-weight:600
   }
   .swal2-progresssteps li{
   display:inline-block;
   position:relative
   }
   .swal2-progresssteps .swal2-progresscircle{
   width:2em;
   height:2em;
   border-radius:2em;
   background:#3085d6;
   color:#fff;
   line-height:2em;
   text-align:center;
   z-index:20
   }
   .swal2-progresssteps .swal2-progresscircle:first-child{
   margin-left:0
   }
   .swal2-progresssteps .swal2-progresscircle:last-child{
   margin-right:0
   }
   .swal2-progresssteps .swal2-progresscircle.swal2-activeprogressstep{
   background:#3085d6
   }
   .swal2-progresssteps .swal2-progresscircle.swal2-activeprogressstep~.swal2-progresscircle{
   background:#add8e6
   }
   .swal2-progresssteps .swal2-progresscircle.swal2-activeprogressstep~.swal2-progressline{
   background:#add8e6
   }
   .swal2-progresssteps .swal2-progressline{
   width:2.5em;
   height:.4em;
   margin:0 -1px;
   background:#3085d6;
   z-index:10
   }
   [class^=swal2]{
   -webkit-tap-highlight-color:transparent
   }
   .swal2-show{
   -webkit-animation:swal2-show .3s;
   animation:swal2-show .3s
   }
   .swal2-show.swal2-noanimation{
   -webkit-animation:none;
   animation:none
   }
   .swal2-hide{
   -webkit-animation:swal2-hide .15s forwards;
   animation:swal2-hide .15s forwards
   }
   .swal2-hide.swal2-noanimation{
   -webkit-animation:none;
   animation:none
   }
   [dir=rtl] .swal2-close{
   right:auto;
   left:0
   }
   .swal2-animate-success-icon .swal2-success-line-tip{
   -webkit-animation:swal2-animate-success-line-tip .75s;
   animation:swal2-animate-success-line-tip .75s
   }
   .swal2-animate-success-icon .swal2-success-line-long{
   -webkit-animation:swal2-animate-success-line-long .75s;
   animation:swal2-animate-success-line-long .75s
   }
   .swal2-animate-success-icon .swal2-success-circular-line-right{
   -webkit-animation:swal2-rotate-success-circular-line 4.25s ease-in;
   animation:swal2-rotate-success-circular-line 4.25s ease-in
   }
   .swal2-animate-error-icon{
   -webkit-animation:swal2-animate-error-icon .5s;
   animation:swal2-animate-error-icon .5s
   }
   .swal2-animate-error-icon .swal2-x-mark{
   -webkit-animation:swal2-animate-error-x-mark .5s;
   animation:swal2-animate-error-x-mark .5s
   }
   @-webkit-keyframes swal2-rotate-loading{
   0%{
   -webkit-transform:rotate(0);
   transform:rotate(0)
   }
   100%{
   -webkit-transform:rotate(360deg);
   transform:rotate(360deg)
   }
   }
   @keyframes swal2-rotate-loading{
   0%{
   -webkit-transform:rotate(0);
   transform:rotate(0)
   }
   100%{
   -webkit-transform:rotate(360deg);
   transform:rotate(360deg)
   }
   }
   /*********** Steps Start***************/
   .horizontal-tabs-steps {
   position: relative;
   }
   .horizontal-tabs-steps .nav-item {
   z-index: 1;
   position: relative;
   }
   .horizontal-tabs-steps .nav-item:after {
   content: "";
   border-top: 5px dotted #73b6ff;
   position: absolute;
   z-index: 0;
   top: 12px;
   width: 265px;
   left: 0px;
   transition: border 1s ease-out;
   transition-delay: 0s, 0s, 0.1s;
   }
   .horizontal-tabs-steps .nav-item:last-child:after {
   content: "";
   border-top: 0px dotted #4da3ff;
   }
   .horizontal-tabs-steps .nav-item.complete-step:after {
   content: "";
   border-top: 5px dotted #4d7ed2;
   position: absolute;
   z-index: 0;
   top: 12px;
   width: 265px;
   left: 0px;
   transition: border 1s ease-out;
   transition-delay: 0s, 0s, 0.1s
   }
   .horizontal-tabs-steps .nav-link {
   background: #fff;
   border-radius: 100%;
   width: 31px;
   height: 31px;
   color: #3c4858;
   padding: 0;
   display: flex;
   justify-content: center;
   align-items: center;
   font-size: 12px;
   border: 2px solid #4d7ed2;
   z-index: 1;
   position: relative;
   }
   .horizontal-tabs-steps .nav-link:hover {
   background: #22437c;
   border: 2px solid #22437c;
   color: #fff !important;
   transition: 0.3s all;
   }
   .horizontal-tabs-steps .nav-link:hover .horizontal-tabs-steps .nav-link span {
   color: #fff !important;
   }
   .horizontal-tabs-steps .nav-item h6 {
   font-size: 12px;
   }
   .horizontal-tabs-steps .nav-item.show .nav-link, .horizontal-tabs-steps .nav-link.active {
   color: #fff;
   background-color: #22437c;
   border-color: #22437c;
   width: 31px;
   height: 31px;
   border-radius: 50%;
   }
   .horizontal-tabs-steps .nav-link.active span {
   color: #fff;
   font-weight: 500 !important;
   }
   .horizontal-tabs-steps .checked-steps span {
   display: none;
   }
   .horizontal-tabs-steps .checked-steps {
   background-color: #22437c !important;
   border: 1px solid #22437c !important;
   color: #fff !important;
   }
   .horizontal-tabs-steps .checked-steps:after {
   content: "\f00c";
   font-family: FontAwesome;
   color: #fff;
   }
   /*********** Steps End***************/
   /*********** Platform Content start***************/
   .platform-content .tab-pane h3 {
   font-size: 15px;
   font-weight: 500 !important;
   }
   .platform-content .tab-pane p {
   font-size: 12px;
   }
   .vertical-tabs-steps.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
   color: #fff;
   background-color: #22437c;
   border-color: #22437c;
   font-size: 12px !important;
   }
   .vertical-tabs-steps .nav-link {
   color: #3c4858;
   border: 1px solid #4d7ed2;
   font-size: 12px !important;
   margin-bottom: 45px;
   border-radius: 15px 15px 15px 15px;
   padding: 10px;
   text-align: center;  
   background: #fff;
   position: relative;
   z-index: 1;  
   width: 80px;
   }
   .vertical-tabs-steps .nav-link.checked-steps {
   text-align: left;
   }
   .vertical-tabs-steps .nav-link:hover {
   color: #fff;
   background-color: #22437c !important;
   border-color: #22437c;
   transition: 0.3s all;
   }
   .vertical-tabs-steps .nav-item {
   position: relative;
   }
   .vertical-tabs-steps .nav-item:last-child:after {
   content: "";
   border-bottom: 0px !important;
   }
   .vertical-tabs-steps .nav-item:after {
   content: "";
   border-bottom: 3px dotted #73b6ff;
   position: absolute;
   width: 95px;
   transform: rotate(90deg);
   z-index: 0;
   left: -10px;
   top: 50px;
   transition: border 1s ease-out;
   transition-delay: 0s, 0s, 0.1s;
   }
   .vertical-tabs-content {
   padding: 0px 15px;
   }
   .vertical-tabs-content p {
   font-size: 12px;
   }
   .vertical-tabs-steps .checked-steps {
   background-color: #22437c !important;
   border: 1px solid #22437c !important;
   color: #fff !important;
   }
   .vertical-tabs-steps .checked-steps:after {
   content: "\f00c";
   font-family: FontAwesome;
   color: #fff;
   position: absolute;
   right: 10px;
   }
   .vertical-tabs-content .tab-pane h3 {
   font-size: 15px;
   font-weight: 500 !important;
   }
   .vertical-tabs-steps .checked-border-item.nav-item:after {
   content: "";
   border-bottom: 0px dotted #ccc !important;
   position: absolute;
   width: 95px;
   transform: rotate(90deg);
   z-index: 0;
   left: -10px;
   top: 50px;
   transition: border 1s ease-out;
   transition-delay: 0s, 0s, 0.1s;
   }
   .vertical-tabs-steps .nav-item.complete-step:after {
   content: "";
   border-bottom: 3px dotted #4d7ed2 !important;
   position: absolute;
   width: 95px;
   transform: rotate(90deg);
   z-index: 0;
   left: -10px;
   top: 50px;
   }
   /*********** Platform Content End***************/
   /*********** Responsive CSS Start***************/
   @media only screen and (max-width: 575px) {
   .vertical-tabs-steps .nav-link {
   width: 73px;
   }  
   .vertical-tabs-steps .nav-link.checked-steps {
   padding: 10px 7px;
   }  
   .vertical-tabs-steps .checked-steps:after {
   content: "\f00c";
   font-family: FontAwesome;
   color: #fff;
   position: absolute;
   right: 7px;
   }  
   }
   @media only screen and (min-width: 992px) and (max-width: 1199px) {
   .horizontal-tabs-steps .nav-item:after {
   content: "";
   width: 219px;
   } 
   }
   @media only screen and (min-width: 768px) and (max-width: 991px) {
   .horizontal-tabs-steps .nav-item:after {
   content: "";
   width: 160px;
   } 
   }
   @media only screen and (min-width: 421px) and (max-width: 767px) {
   .horizontal-tabs-steps .nav-item:after {
   content: "";
   width: 115px;
   } 
   }
   @media only screen and (max-width: 420px) {
   .horizontal-tabs-steps .nav-item:after {
   content: "";
   width: 95px;
   } 
   }
   /*********** Responsive CSS End***************/
</style>
<script>
   $(document).ready(function() {
   $(".vertical-tabs-steps .nav-link, .horizontal-tabs-steps .nav-link").click(function() {
   $(this).parent().prevAll().children('.vertical-tabs-steps .nav-link, .horizontal-tabs-steps .nav-link').addClass('checked-steps');
   
   $(this).parent().nextAll().children('.vertical-tabs-steps .nav-link, .horizontal-tabs-steps .nav-link').removeClass('checked-steps');
   
   $(this).removeClass('checked-steps');
   $(this).parent().removeClass('complete-step');
   $(this).parent().nextAll().removeClass('complete-step');
   
   $(".horizontal-tabs-steps .nav-link.checked-steps, .vertical-tabs-steps .nav-link.checked-steps").parent().addClass('complete-step');
   });
   });
</script>
@endsection