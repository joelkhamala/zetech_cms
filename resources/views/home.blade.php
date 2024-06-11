@extends('layouts.main')
@section('content')
<!--
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-8">
               <div class="card">
                   <div class="card-header">{{ __('Dashboard') }}</div>
   
                   <div class="card-body table-responsive">
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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Registrar Dashboard</h1>
   
</div>
<!-- Content Row -->
<div class="row">
   <!-- Fees Paid  -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body table-responsive">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                     Total Students in the System
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $studNumber }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-globe fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Fees Remaining -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body table-responsive">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                     Students Approved for Graduation
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $studApprovedNumber }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-check fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Pending Approval Requests Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body table-responsive">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                     Not Approved
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $studNumber - $studApprovedNumber }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-times fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Progress Bar -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
         <div class="card-body table-responsive">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Overall Clearance Progress
                  </div>
                  <div class="row no-gutters align-items-center">
                     <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                           @if($studNumber<=0)
                           {{
                           $studpercent = 0;
                           }}%
                           @else
                           {{
                           round(($studpercent = (($studApprovedNumber)/$studNumber) * 100),2)
                           }}%
                           @endif
                        </div>
                     </div>
                     <div class="col">
                        <div class="progress progress-sm mr-2">
                           <div class="progress-bar bg-info" role="progressbar"
                              style="width: {{ $studpercent }}%" aria-valuenow="{{ $studpercent }}" aria-valuemin="0"
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
<style>
   .search {
   width: 100%;
   margin-bottom: auto;
   margin-top: 20px;
   height: 50px;
   background-color: #fff;
   padding: 10px;
   border-radius: 5px;
   }
   .search-input {
   color: white;
   border: 0;
   outline: 0;
   background: none;
   width: 0;
   margin-top: 5px;
   caret-color: transparent;
   line-height: 20px;
   transition: width 0.4s linear
   }
   .search .search-input {
   padding: 0 10px;
   width: 100%;
   caret-color: #536bf6;
   font-size: 19px;
   font-weight: 300;
   color: black;
   transition: width 0.4s linear;
   }
   .search-icon {
   height: 34px;
   width: 34px;
   float: right;
   display: flex;
   justify-content: center;
   align-items: center;
   color: white;
   background-color: #536bf6;
   font-size: 10px;
   bottom: 30px;
   position: relative;
   border-radius: 5px;
   }
   .search-icon:hover{
   color: #fff !important;
   }
   a:link {
   text-decoration: none
   }
   .card-inner {
   position: relative;
   display: flex;
   flex-direction: column;
   min-width: 0;
   word-wrap: break-word;
   background-color: #fff;
   background-clip: border-box;
   border: 1px solid rgba(0,0,0,.125);
   border-radius: .25rem;
   border:none;
   cursor: pointer;
   transition: all 2s;
   }
   .card-inner:hover{
   transform: scale(1.1);
   }
   .mg-text span{
   font-size: 12px;
   }
   .mg-text{
   line-height: 14px;
   }
</style>
<div class="container-fluid mt-4 mb-4">
   <div class="row d-flex justify-content-center">
      <div class="col-md-9">
         <div class="card p-4 mt-3">
            <h5 class="text-center">My ShortCuts</h5>
            <div class="row mt-4 g-1 px-4 mb-5">
               <div class="col-md-2">
                  <div class="card-inner p-3 d-flex flex-column align-items-center text-center">
                  <a href="{{url('departments')}}" style="text-decoration:none">
                     <i class="fas fa-building fa-3x text-info"></i> 
                     <div class="text-center mg-text"> <span class="mg-text text-dark">Departments</span> </div>
                  </a>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="card-inner p-3 d-flex flex-column align-items-center text-center">
                     <a href="{{url('programs')}}" style="text-decoration:none">
                        <i class="fas fa-list fa-3x text-info"></i> 
                        <div class="text-center mg-text"> <span class="mg-text text-dark">Programs</span> </div>
                     </a>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="card-inner p-3 d-flex flex-column align-items-center text-center">
                  <a href="{{url('viewAllStudents')}}" style="text-decoration:none">
                     <i class="fas fa-graduation-cap fa-3x text-info"></i> 
                     <div class="text-center mg-text"> <span class="mg-text text-dark">Students</span> </div>
                  </a>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="card-inner p-3 d-flex flex-column align-items-center text-center">
                  <a href="{{url('transcripts')}}" style="text-decoration:none">
                     <i class="fas fa-file fa-3x text-info"></i>
                     <div class="text-center mg-text"> <span class="mg-text text-dark">Trascripts</span> </div>
                  </a>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="card-inner p-3 d-flex flex-column align-items-center text-center">
                  <a href="{{url('certificates')}}" style="text-decoration:none">
                     <i class="fas fa-certificate fa-3x text-info"></i> 
                     <div class="text-center mg-text"> <span class="mg-text text-dark">Certificates</span> </div>
                  </a>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="card-inner p-3 d-flex flex-column align-items-center text-center">
                  <a href="{{url('feesView')}}" style="text-decoration:none">
                     <i class="fas fa-usd fa-3x text-info"></i>
                     <div class="text-center mg-text"> <span class="mg-text text-dark">Finance</span> </div>
                  </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection