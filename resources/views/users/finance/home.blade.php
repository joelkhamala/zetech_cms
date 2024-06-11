@extends('users.finance.app')

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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        
                    </div>
    <div class="mx-auto justify-content-center col-md-6 text-center" id="mydiv">
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
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Students in the System</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$students->count()}}</div>
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
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Fees Expected</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Kshs. 20,000,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-usd fa-2x text-gray-300"></i>
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
                                                Fees Collected</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Kshs. {{number_format($fees)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-usd fa-2x text-gray-300"></i>
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
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Fees Progress
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        {{($fees/20000000)*100}}
                                                        %</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: {{($fees/20000000)*100}}%" aria-valuenow="{{($fees/20000000)*100}}" aria-valuemin="0"
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
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                            <i class="fas fa-usd"></i> &nbspFees Data
                            </div>
                            <div class="card-body table-responsive">
                            <table class="table table-hover table-stripped table-bordered"  id="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Amount</th>
                <th scope="col">Reason</th>
                <th scope="col">Bank Paid From</th>
                <th scope="col">Transaction Code</th>
                </tr>
            </thead>
            <tbody>
                <span style="display:none">
                    {{$i=1}}
                </span>
                @if($feesData->count()>0)
                    @foreach($feesData as $feeData)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$feeData->email}}</td>
                            <td>Kshs. {{number_format($feeData->amount)}}</td>
                            <td>{{$feeData->reason}}</td>
                            <td>{{ $feeData->bank }}</td>
                            <td>{{$feeData->code }}</td>
                        </tr>
                        <span style="display:none">
                            {{$i++}}
                        </span>
                    @endforeach
                    <tr>
                        <th>Totals Collected</th>
                        <th colspan="6" class="text-center">Kshs. {{ number_format($fees) }}</th>
                    </tr>
                @else
                    <tr>
                        <td colspan="11"><div class="alert alert-danger">No Fee Record Found</div></td>
                    </tr>
                @endif
            </tbody>
            </table>
                            </div>
                        </div>
                    </div>
                    
@endsection