@extends('layouts.main')

@section('content')
<!-- Dropdown - Messages -->

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Gowns Issuance</h1>
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
                    <div class="col-md-6">
                        <i class="fas fa-graduation-cap"></i>
                        &nbsp Gowns in Store
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <form method="GET" action="{{route('gowns.index')}}" class="form-inline">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="search" placeholder="Search role" name="search" class="form-control form-control-sm"/>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mb-2"><i class="fas fa-search"></i> &nbsp{{ __('Search') }}</button>
                        </form> &nbsp
                        <a href="{{route('newGowns')}}" class="btn btn-primary btn-sm mb-2">
                            <i class="fas fa-plus"></i>
                            &nbsp <span class="d-none d-lg-inline ">Create New Gown Record</span>
                        </a>
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
                <th scope="col">Availability</th>
                <th scope="col-2">Action</th>
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
                    <td>
                        @if($gown->returned == 'not returned')
                        <div class="btn btn-danger btn-sm"><i class="fas fa-times"></i> &nbsp<span class="d-lg-inline">Not Available</span></div>
                        @else
                        <div class="btn btn-success btn-sm"><i class="fas fa-check"></i> &nbsp<span class="d-lg-inline">Available</span></div>
                        @endif
                    </td>
                    <td scope="col-2">
                        <div class="d-flex justify-contents-center">
                            <a href="{{route('gowns.edit', $gown->gown_id)}}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                                &nbsp<span class="d-none d-lg-inline">Edit gown Details</span>
                            </a>&nbsp
                            <form method="POST" action="{{route('gowns.destroy', $gown->gown_id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>&nbsp<span class="d-none d-lg-inline">Delete Gown Details</span></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @if($gowns->isEmpty())
                    <tr>
                        <td colspan="7"><div class="alert alert-danger">Records for Gowns Not Found</div></td>
                    </tr>
                @endif
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection