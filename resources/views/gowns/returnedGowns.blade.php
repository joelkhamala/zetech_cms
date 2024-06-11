@extends('layouts.main')

@section('content')
<!-- Dropdown - Messages -->

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Returned Gowns</h1>
</div>
<div class="row mb-4">
    <div class="justify-content-center mx-auto">
        <div>
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div class=" container-fluid">
        <div class="card mx-auto">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-7">
                        <i class="fas fa-graduation-cap"></i>
                        &nbsp Gowns Returned
                    </div>
                    <div class="col-md-5 d-flex align-items-center justify-content-center">
                        <form method="GET" action="{{route('issuedGowns')}}" class="form-inline">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="search" placeholder="Search Gown" name="search" class="form-control form-control-sm"/>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mb-2"><i class="fas fa-search"></i> &nbsp{{ __('Search') }}</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="card-body table-responsive">
            <table class="table table-hover table-stripped table-bordered" " id="table">
            <thead>
                <tr>
                <th scope="col">Gown ID</th>
                <th scope="col">Gown Serial Number</th>
                <th scope="col">Issued To</th>
                <th scope="col">Gown Size</th>
                <th scope="col">Gown Condition</th>
                <th scope="col">Issuance</th>
                <th scope="col">Return Status</th>
                <th scope="col">Availability</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gowns as $gown)
                <tr>
                    <th scope="row">{{$gown->gown_id}}</th>
                    <td>{{$gown->gown_serial_number}}</td>
                    <td>
                        @if($gown->email == 'gown@gownsdepartment.com')
                        Not Issued
                        @else
                        {{$gown->email}}
                        @endif
                    </td>
                    <td>{{ucwords($gown->size)}}</td>
                    <td>{{ucwords($gown->condition)}}</td>
                    <td>{{ucwords($gown->picked)}}</td>
                    <td>{{ucwords($gown->returned)}}</td>
                    <td>
                        @if($gown->returned == 'not returned')
                        <div class="btn btn-danger btn-sm"><i class="fas fa-times"></i> &nbspNot Available</div>
                        @else
                        <div class="btn btn-success btn-sm"><i class="fas fa-check"></i> &nbspAvailable</div>
                        @endif
                    </td>
                </tr>
                @endforeach
                @if($gowns->isEmpty())
                    <tr>
                        <td colspan="8"><div class="alert alert-danger">Records for Gowns Not Found</div></td>
                    </tr>
                @endif
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection