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
<div class="d-sm-flex align-items-center justify-content-between">
   <h1 class="h3 mb-0 text-gray-800">Student Dashboard</h1>
</div>
<div class="mx-auto mb-4 justify-content-center col-md-6 text-center" id="mydiv">
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
<!-- Content Row -->
<div class="row">
   <!-- Fees Paid  -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                     Tuition Fees Balance
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                     @foreach($finances as $finance)
                        @if($finances->contains('email',Auth::User()->email) && Auth::User()->email == $finance->email)
                        Kshs. {{number_format($finance->school_fees)}}
                        @endif
                     @endforeach
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-usd fa-2x text-gray-300"></i>
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
                     Graduation Fee Balance
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                     @foreach($finances as $finance)
                        @if($finances->contains('email',Auth::User()->email) && Auth::User()->email == $finance->email)
                        Kshs. {{number_format($finance->gown_fees)}}
                        @endif
                     @endforeach
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
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
                     Total Fee Balance
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                     @foreach($finances as $finance)
                        @if($finances->contains('email',Auth::User()->email) && Auth::User()->email == $finance->email)
                        Kshs. {{number_format($finance->school_fees + $finance->gown_fees)}}
                        @endif
                     @endforeach
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-credit-card fa-2x text-gray-300"></i>
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
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">70%</div>
                     </div>
                     <div class="col">
                        <div class="progress progress-sm mr-2">
                           <div class="progress-bar bg-info" role="progressbar"
                              style="width: 70%" aria-valuenow="70" aria-valuemin="0"
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
<div class="container-fluid mb-4">
   <div class="row">
      <div class="col-12 col-sm-4 mb-4">
         <div class="container mb-2">
            <div class="row">
               <div class="card border-danger golge">
                  <div class="card-header">
                     <span class="isteColor">
                        <h5 class="m-2" style="font-weight: bold">
                            <i class="fas fa-commenting"></i>&nbsp
                            Remarks
                        </h5>
                    </span>
                  </div>
                  <div class="card-body">
                     <div class="carousel vert slide" data-ride="carousel" data-interval="2000" style="max-height:300px">
                        <div class="carousel-inner">
                           <div class="carousel-item active">
                              <ul class="timeline">
                                <li>Remarks from the different departments will appear here when they are inserted</li><hr>
                                 @foreach($remarks as $remark)
                                 @if(Auth::User()->id == $remark->remark_to)
                                 <li>
                                    <a target="_blank" href="#">{{ $remark->remark_title}}</a>
                                    <a href="#" class="float-right">{{ $remark->created_at}}</a>
                                    <p class="article">
                                       <span>
                                       {{ $remark->remark}}
                                       </span>
                                       <span class="float-right">
                                       @foreach($users as $user)
                                       @if($remark->user_id == $user->id)
                                       <em>{{ $user->user_name }}</em>
                                       @endif
                                       @endforeach
                                       </span>
                                    </p>
                                 </li>
                                 <hr>
                                @endif
                                 @endforeach
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card bg-light mb-3">
            <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i>&nbsp General System Information</div>
            <div class="card-body">
               <p><span class="text-dark font-weight-bold">User Name: </span> {{ $student->user_name }}</p>
               <p><span class="text-dark font-weight-bold">Email: </span> {{ $student->email }}</p>
               <p><span class="text-dark font-weight-bold">Phone Number: </span> {{ $student->phone }}</p>
               <p><span class="text-dark font-weight-bold">Guardian Number: </span> {{ $student->guardianPhone }}</p>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card mb-4">
            <div class="card-header bg-primary text-white"><i class="fa fa-user"></i>&nbsp My Profile
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="card-title mb-4">
                              <div class="d-flex justify-content-start">
                                 <div class="image-container">
                                    <img src="{{url('images/undraw_profile.svg')}}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                    <div class="middle">
                                       <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                       <input type="file" style="display: none;" id="profilePicture" name="file" />
                                    </div>
                                 </div>
                                 <div class="userData ml-3 my-auto">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">
                                    <a href="javascript:void(0);">
                                        {{$student->first_name.' '.$student->last_name}}
                                    </a></h2>
                                    <i class="d-block" style="font-size: 1rem; font-weight: bold">
                                    <a href="javascript:void(0);" class="text-dark">
                                        @foreach($programs as $program)
                                             @if($student->program_id == $program->program_id)
                                                <span style="font-size:0.9rem">{{ ucwords($program->program_type) }} Student</span><br>
                                                {{ $program->program_name.' ('.$program->program_code.')' }}
                                             @endif
                                             @endforeach
                                        </a>
                                    </i>
                                    <i class="d-block" style="font-size: 0.7rem; font-weight: bold">
                                    <a href="javascript:void(0);" class="text-info">
                                            @foreach($departments as $department)
                                             @if($student->department_id == $department->department_id)
                                                {{ $department->department_name }}
                                             @endif
                                             @endforeach
                                        </a>
                                    </i>
                                 </div>
                                 <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                       <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                    </li>
                                    <li class="nav-item">
                                       <a class="nav-link" id="graduationdetails-tab" data-toggle="tab" href="#graduationdetails" role="tab" aria-controls="graduationdetails" aria-selected="false">Graduation Details</a>
                                    </li>
                                 </ul>
                                 <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                       <div class="row">
                                          <div class="col-sm-3 col-md-3 col-5">
                                             <label style="font-weight:bold;">Full Name</label>
                                          </div>
                                          <div class="col-md-8 col-6">
                                             {{$student->first_name.' '.$student->middle_name.' '.$student->last_name}} &nbsp | &nbsp
                                             <em>Status: <i style="font-weight:600">{{$student->confirmed}}</i></em>
                                          </div>
                                       </div>
                                       <hr />
                                       <div class="row">
                                          <div class="col-sm-3 col-md-3 col-5">
                                             <label style="font-weight:bold;">National ID</label>
                                          </div>
                                          <div class="col-md-8 col-6">
                                          {{$student->national_id}}
                                          </div>
                                       </div>
                                       <hr />
                                       <div class="row">
                                          <div class="col-sm-3 col-md-3 col-5">
                                             <label style="font-weight:bold;">Admission Number</label>
                                          </div>
                                          <div class="col-md-8 col-6">
                                          {{$student->admissionNumber}}
                                          </div>
                                       </div>
                                       <hr />
                                       <div class="row">
                                          <div class="col-sm-3 col-md-3 col-5">
                                             <label style="font-weight:bold;">Date of Admission</label>
                                          </div>
                                          <div class="col-md-8 col-6">
                                             {{$student->yearOfAdmission}}
                                          </div>
                                       </div>
                                       <hr />
                                       <div class="row">
                                          <div class="col-sm-3 col-md-3 col-5">
                                             <label style="font-weight:bold;">Department</label>
                                          </div>
                                          <div class="col-md-8 col-6">
                                             @foreach($departments as $department)
                                             @if($student->department_id == $department->department_id)
                                                {{ $department->department_name }}
                                             @endif
                                             @endforeach
                                          </div>
                                       </div>
                                       <hr />
                                       <div class="row">
                                          <div class="col-sm-3 col-md-3 col-5">
                                             <label style="font-weight:bold;">Course</label>
                                          </div>
                                          <div class="col-md-8 col-6">
                                          @foreach($programs as $program)
                                             @if($student->program_id == $program->program_id)
                                                {{ $program->program_name.' ('.$program->program_code.')' }}
                                             @endif
                                             @endforeach
                                          </div>
                                       </div>
                                       <hr />
                                    </div>
                                    <div class="tab-pane fade" id="graduationdetails" role="tabpanel" aria-labelledby="graduationdetails-tab">
                                       Graduation Details Here
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@break
@endif
@endforeach
<style>
   /*
   ** Style Simple Ecommerce Theme for Bootstrap 4
   ** Created by T-PHP https://t-php.fr/43-theme-ecommerce-bootstrap-4.html
   */
  .image-container {
            position: relative;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .image-container:hover .image {
            opacity: 0.3;
        }

        .image-container:hover .middle {
            opacity: 1;
        }




   .isteColor{
   color: #cd2147;
   }
   .isteColor:hover{
   color: #353A40;
   }
   /*haber akışı list*/
   ul.timeline {
   list-style-type: none;
   position: relative;
   }
   ul.timeline:before {
   content: ' ';
   background: #d4d9df;
   display: inline-block;
   position: absolute;
   left: 29px;
   width: 2px;
   height: 100%;
   z-index: 400;
   }
   ul.timeline > li {
   margin: 20px 0;
   padding-left: 20px;
   }
   ul.timeline > li:before {
   content: ' ';
   background: white;
   display: inline-block;
   position: absolute;
   border-radius: 50%;
   border: 3px solid #cd2147;
   left: 20px;
   width: 20px;
   height: 20px;
   z-index: 400;
   }
   /*vertical carousel*/
   .vert .carousel-item-next.carousel-item-left,
   .vert .carousel-item-prev.carousel-item-right {
   -webkit-transform: translate3d(0, 0, 0);
   transform: translate3d(0, 0, 0);
   }
   .vert .carousel-item-next,
   .vert .active.carousel-item-right {
   -webkit-transform: translate3d(0, 100%, 0);
   transform: translate3d(0, 100% 0);
   }
   .vert .carousel-item-prev,
   .vert .active.carousel-item-left {
   -webkit-transform: translate3d(0,-100%, 0);
   transform: translate3d(0,-100%, 0);
   }
   .bloc_left_price {
   color: #c01508;
   text-align: center;
   font-weight: bold;
   font-size: 150%;
   }
   .category_block li:hover {
   background-color: #007bff;
   }
   .category_block li:hover a {
   color: #ffffff;
   }
   .category_block li a {
   color: #343a40;
   }
   .add_to_cart_block .price {
   color: #c01508;
   text-align: center;
   font-weight: bold;
   font-size: 200%;
   margin-bottom: 0;
   }
   .add_to_cart_block .price_discounted {
   color: #343a40;
   text-align: center;
   text-decoration: line-through;
   font-size: 140%;
   }
   .product_rassurance {
   padding: 10px;
   margin-top: 15px;
   background: #ffffff;
   border: 1px solid #6c757d;
   color: #6c757d;
   }
   .product_rassurance .list-inline {
   margin-bottom: 0;
   text-transform: uppercase;
   text-align: center;
   }
   .product_rassurance .list-inline li:hover {
   color: #343a40;
   }
   .reviews_product .fa-star {
   color: gold;
   }
   .pagination {
   margin-top: 20px;
   }
   footer {
   background: #343a40;
   padding: 40px;
   }
   footer a {
   color: #f8f9fa!important
   }
</style>

<script>
    $(document).ready(function () {
            $imgSrc = $('#imgProfile').attr('src');
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imgProfile').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#btnChangePicture').on('click', function () {
                // document.getElementById('profilePicture').click();
                if (!$('#btnChangePicture').hasClass('changing')) {
                    $('#profilePicture').click();
                }
                else {
                    // change
                }
            });
            $('#profilePicture').on('change', function () {
                readURL(this);
                $('#btnChangePicture').addClass('changing');
                $('#btnChangePicture').attr('value', 'Confirm');
                $('#btnDiscard').removeClass('d-none');
                // $('#imgProfile').attr('src', '');
            });
            $('#btnDiscard').on('click', function () {
                // if ($('#btnDiscard').hasClass('d-none')) {
                $('#btnChangePicture').removeClass('changing');
                $('#btnChangePicture').attr('value', 'Change');
                $('#btnDiscard').addClass('d-none');
                $('#imgProfile').attr('src', $imgSrc);
                $('#profilePicture').val('');
                // }
            });
        });
</script>
<!-- <div class="container">
   <div class="row">
    <div class="col col-sm-12">
              <div class="shadow hoverCustomCard">
                  <div class="CustomCardheader text-white btn-primary">
                      <h5 class="col pt-2"><strong>{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</strong></h5>
                      <i class="far pt-2 pr-3 fa-heart float-right pointer" style="position:absolute;right:0;top:0"
                      > 99</i>
                  </div>
                  <div class="avatar">
                      <img alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAMAAACahl6sAAAAM1BMVEUKME7///+El6bw8vQZPVlHZHpmfpHCy9Ojsbzg5ekpSmTR2N44V29XcYayvsd2i5yTpLFbvRYnAAAJcklEQVR4nO2d17arOgxFs+kkofz/154Qmg0uKsuQccddT/vhnOCJLclFMo+//4gedzcApf9B4srrusk+GsqPpj+ypq7zVE9LAdLWWVU+Hx69y2FMwAMGyfusLHwIpooyw9IAQfK+8naDp3OGHvZ0FMhrfPMgVnVjC2kABOQ1MLvi0DEIFj1ILu0LU2WjNRgtSF3pKb4qqtd9IHmjGlJHlc09IHlGcrQcPeUjTAySAGNSkQlRhCCJMGaUC0HSYUx6SmxFAtJDTdylsr4ApC1TY0yquKbCBkk7qnYVzPHFBHkBojhVJWviwgPJrsP4qBgTgbQXdsesjm4pDJDmIuswVZDdFx0ENTtkihoeqSDXD6tVxOFFBHndMKxWvUnzexpIcx/Gg2goJJDhVo6PCMGRAnKTmZuKm3wcJO/upphUqUHy29yVrRhJDORXOKIkEZDf4YiRhEF+iSNCEgb5KY4wSRDkB/yurUEG8nMcocgYABnvbrVL3nMIP0h/d5udKnwzSC/InfPdkJ6eWb0PJE++dyVVyQP5iQmWW27X5QG5druEKafBu0Hqu9saVOHa8HKC/K6BzHKZiRMEZCDF0Nd1/ZfXI/fcOibHOssFgokg9uFA20BhztHEAZIjIohrD/o1wljeFBDEwBo8YUt5Ir/rNLjOIACPFdy/AbEcPdcJBOCxytjeYAM4Kzp6rhOIPhRGNzwmFP3rOoTFI0irtnQKx6fj1Zt+h9njEUS9mKJxfFRrX5lt7wcQtaWTOfTHeIXVJQcQrRW+OYex2j0a66XZINoO8a7fPH2iHF2mC7ZBtB3Czb5QvjizSx7A3308mRzqAwujSywQbYfwc0iU8zqjS0yQ6ztEHX9332KCaGNIYB/Qq1z3yN0oDZBWyeFYJBCkm2sXLhDtpKFwNDMu5TnrZpYGiHbK4Nlwikg5DrYV1g6iPoJmzE5MKd/fOp53EPUaQZaLqH3u+vo2ELWp3wSyWuYGoj9EEIJoV3L9AUS/ZLsJpLNBXmqOu0CW6P5A/dx9IL0FAji/FYKot9EqE0Tvs6QBUe/2CxMEkZAlBNGPhdoAQWyTSmbxUwvUygwQyMmniAPgLt87CODXHuftWJIQgzrfQDC5AfwSgz9MmmG/gWCOqDgZ4JsQeTvZBoJJDhAFEsSDyxUEEUUekk0UEMhjBcEcGsoWVpBU3NcCgkkPkJWrKbdRZvULCMTWhYEdMrayBQRyqHcnSLmAIH7LcWJ8Hch7BsHEdWFpJsZjziCgFBpZ9TPm4e0XBJTTJKt9xjy8RoLI4gimPLP5goCSgWTrEcyzsy8IqmZVMo0H5bJiQToBCOjZ5RcElhjLN3dU7uQMAvoxwQkJZKI1CQzCthJYEigahHuDDi4rFwzCPQ7F1fiDQZgTR5iJwEGYRgIsiECD8BwwMAEfDcIaW8CRBQdhjS1kJQEchDEFhiRKr4KDFPS9FGQNVwEHoW83QjsEHdkfnuIOl6C1NjMItiaCaCWgbdpFJXQ9soh2uoB9aJcCxFdgZwlcrTmvENGlrITBBdpK25Qhd1F2RScq8CKu/gsCL8qN5THjy+Rr5E6joYgPxpdl518QrCf8Kpgjn6C8HLkbb+vt7ZM8wdVvy258khsRfHaS5DalDnlidZT7Erk+SXV5Bj1D3LS29XyhVJuoKHs9Q8S6reK11oUc7vPcr9uswP3SLiDINefXOF5rwCuGzVT6zVkVPfh2wWmHcz4wAwba2cgN1/Tsvleu7//i69CgVyt1GwjOs2+XK3rtbl151Tg3vOeioG40Mz2V+6pQ4xbJHOZj6g0EMxk93tV7fuedvVZpQSPhbwNBGInrymGrwNh1GXmL8F+lAaJ+NU/fzcmvJqvKj7177+1v1GY/GiBKI1Fdy/2XK6upXwaIJpI8B/399W0mH9zzafKaeCF9J0WF+jyCuFusTGzZKhFH8dVLZql2brxgcdVBKb7KG/7UZTmB3XJ6uL/QYT5ScRI74FcHEJ7feopyfGkaeaGlPoCw/BbjZmSBWIvINQNmTxdjWJqwUI8sztR4nYPuIPSTSUnOCZOE3ierqRoJfNSQxDjLEYs8i91eqgFCDSWiFHiuqAN9CwEGCPEISVjvwhS7Mfx6dtX8kC5aqvneGBOEFN2v6RBiYwr3DQOkLhEW6fHFbIwFQnkLiWYmZxE220z/aedPx99C+hiyKR4OzNFhg8S75CJTnxQ1dyugHTLaY10iu9dBpmhQtMz1ABLrkgtHVnRsPUO3OcU25i8cWdGxZbflCBKJqBdMs3aF/dYhNexU9RFcYEmLXYQKghyWdufyldBSU3KpjkKhZclxTXQGCTkL/HZDUIH5+Gkt4SgoCtj7pSYSNJLTK3VVRnmXZxebSMBIzmHABeIdXBebiN9eHYtUZ62ab3BdGkUm+SKJw1bdRXeewaX7qqdAnljg2sVxg3guAk3baofcg9yZ2eZpnHNvSFrEqhB9YPjesmt0pt6Xc8hl7W5L9Q4Xx09ctsrd5VhWeF6nF8SRrZdw49qns//0xTK/AZ8vGr3caTliuzeFNeCJTgafpKlhHd2WP1sy1LqDF798gjKJPLqDr9keoTd43+NyNzC1CI8Xy2lcPtOaVBI5IiAWyQ3e125AcKoXs2Djhy5eVc3KiBxREIPkhjBiLhIjU++4T91IbggjRiCJLSEIwWGddkEaxlVN5KCArPHk8mXVpHk8FHH7JL3n5dPA7C90q7XkeFJucacNmGXeRfswLE71HA79efaGiCN/Ofjmfmtcp8X10tIsqCacV5xfRWjNUiXGYbovWgyFYHcQLak15K9oM5zqmgaeKsHJetbSHfSPzXOiw/rxE9YH4CXaUpsZ0ztemFurP95Jpyvrd29YTpIZr7cEJHqfc7Wl0PFm2+yJR70udaokKFtGPTdm8WdQe24+HmVLlueboWQquBcYYVH2vEzfh8kCks1p90eWsLCyZ8qK7E86Oe+3XYFnBuiWdth20UqZR5SvMoyPg3WNauJipi0LMTQgVq5xUUlZcrPsopPHJ926z8pm7xyFLrH/PxpHSoXKdWgXsLn1scZn1ZDd/2vszN3lt254qkE+qu3yoqLM+ghN3Qz2qcVzUC/ZMFsK/alU6l0OWV/bQz6v6yYbyuN5BaZ4A7Y30vs/PPksS2+qzlvfF7OQmzzcL7W+xa7OIfRuVdtn/tdvdFLnL4OTKcm2W16PmWc4FWWXNSlWM2n3D+uPxuyrcfo74aP+Ac30a82+oLmfAAAAAElFTkSuQmCC">
                  </div>
                  <div class="info">
                      <div class="desc"> simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                          the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                          of type and scrambled it to make a type specimen book.</div>
                      <footer class="blockquote-footer float-right">Someone in <cite title="Source Title">Source
                              Title</cite></footer>
                  </div>
                  <div class="bottom mx-auto">
                      <a class="btn btn-secondary btn-twitter btn-sm">
                          <i class="fas fa-user-lock text-white pointer"></i>
                      </a>
                      <a class="btn btn-primary btn-sm mx-2" rel="publisher">
                          <i class="fas fa-globe-africa text-white pointer"></i>
                      </a>
                      <a class="btn btn-warning btn-sm" rel="publisher">
                          <i class="fas fa-exclamation-circle text-white pointer"></i>
                      </a>
                      <a class="btn btn-danger btn-sm ml-2" rel="publisher" href="https://plus.google.com/shahnuralam">
                          <i class="fas fa-trash-alt text-white pointer"></i>
                      </a>
                  </div>
              </div>
      </div>
   </div>
   </div>
   
   <style>
   
   .shadow {
    padding-top: 20px;
    margin: 10px 0 20px 0;
    background-color: rgba(214, 224, 226, 0.2);
    border-top-width: 0;
    border-bottom-width: 2px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 15px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
   }
   
   .shadow.hoverCustomCard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
   }
   
   .shadow.hoverCustomCard .CustomCardheader {
    background-size: cover;
    height: 100px;
   }
   
   .shadow.hoverCustomCard .avatar {
    position: relative;
    top: -50px;
    margin-bottom: -50px;
   }
   
   .shadow.hoverCustomCard .avatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.5);
   }
   
   .shadow.hoverCustomCard .info {
    padding: 8px 16px 20px;
   }
   
   .shadow.hoverCustomCard .info .desc {
    overflow: hidden;
    font-size: 16px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
   }
   
   .shadow.hoverCustomCard .bottom {
    padding: 20px 5px;
    margin-bottom: -6px;
    text-align: center;
   }
   
   .btn{ border-radius: 50%; width:30px; height:30px; line-height:18px;  }
   
   </style> -->
@endsection