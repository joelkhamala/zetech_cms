@extends('users.librarian.app')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">
      @foreach($departments as $department) 
      @if(Auth::user()->department_id == $department->department_id)
      Librarian ({{ $department->department_name }})
      @endif
      @endforeach
   </h1>
   
</div>
<!-- Content Row -->
<div class="row">
   <!-- Fees Paid  -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                     Students Cleared
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $clearanceReports->count() }}
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-check fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Fees Remaining -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                     Students Remaining
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                     {{ $clearNots->count()}}
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-times fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Pending Approval Requests Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                     Pending Books
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $pendingBooks->count()}}
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-book fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Progress Bar -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Overall Clearance Progress
                  </div>
                  <div class="row no-gutters align-items-center">
                     <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                        @if($clearanceReports->count() == '0')
                           {{$progPercent = 0}}
                        @else
                           {{ $progPercent = round(((($clearanceReports->count())/($clearanceReports->count() + $pendingBooks->count())) * 100),2) }}
                        @endif
                        %
                        </div>
                     </div>
                     <div class="col">
                        <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: {{$progPercent}}%" aria-valuenow="{{$progPercent}}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-tasks fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection