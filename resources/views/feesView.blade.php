@extends('layouts.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Fees Payments</h1>
                        
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