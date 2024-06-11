@extends('layouts.main')

@section('content')
<!-- Dropdown - Messages -->

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between">
    <h1 class="h3 mb-0 text-gray-800">Transcripts</h1>
</div>
<div class="row mb-4">
    <div class=" container-fluid">
    <div class="mx-auto mb-4 justify-content-center col-md-6 text-center" id="mydiv">
        <div>
            @if(session()->has('message'))
            {{$errclass=''}}
            <span style="display:none">
                @if(str_contains(session('message'), 'are'))
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

    <script>
        $(document).ready(function(){
        $("#mydiv").fadeIn(500);
        $("#mydiv").fadeOut(5000);
    });
    </script>
        <div class="card mx-auto">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <i class="fas fa-file"></i>
                        &nbsp Transcripts <b>({{$transcripts->count()}} Record(s) Found)</b>
                    </div>
                </div>
            </div>

            <div class="card-body">
            <table class="table table-hover table-stripped table-bordered" " id="table">
            <thead>
                <tr>
                <th scope="col">Transcript ID</th>
                <th scope="col">Transcript Serial Number</th>
                <th scope="col">Student Email</th>
                <th scope="col">Student Department</th>
                <th scope="col">Student Program</th>
                <th scope="col-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transcripts as $transcript)
                <tr>
                    <th scope="row">{{$transcript->transcript_id}}</th>
                    <td>{{$transcript->transcript_serial_number}}</td>
                    <td>{{$transcript->email}}</td>
                    <td>
                        @foreach($departments as $department)
                        @if($transcript->department_id == '0')
                            Administrator
                            @break
                        @endif
                        @if($transcript->department_id == $department->department_id)
                        {{$department->department_name}}
                        @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($programs as $program)
                        @if($transcript->program_id == $program->program_id)
                        {{$program->program_name}}
                        @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{URL::to('/documents/transcripts/'.$transcript->file_name )}}" class="btn btn-primary btn-sm"><i class="fas fa-cloud-download"></i>&nbspDownload</a>
                    </td>
                </tr>
                @endforeach
                @if($transcripts->isEmpty())
                    <tr>
                        <td colspan="12"><div class="alert alert-danger">No Transcripts Added Yet</div></td>
                    </tr>
                @endif
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection