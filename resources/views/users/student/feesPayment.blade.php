@extends('users.student.app')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">
   Fees Payment
</div>
<div class="container-fluid mb-4">
   <div class="row justify-content-center">
      <div class="justify-content-center mx-auto col-md-8 text-center">
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
      <div class="col-md-12 mb-4">
         <div class="card shadow-sm">
            <div class="text-center mt-2">
               <h4>My Fee Payment Details</h4>
            </div>
            <div class="card-body table-responsive">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th scope="col">Full Names</th>
                        <th scope="col">School Fees Balance</th>
                        <th scope="col">Gown Fees Balance</th>
                        <th scope="col">Total Fees Balance</th>
                        <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if($finances->count()>0)
                     @foreach($finances as $finance)
                     @if($finance->email == Auth::User()->email)
                     <tr>
                        <td>{{Auth::User()->first_name.' '.Auth::User()->last_name}}</td>
                        <td>Kshs. {{number_format($finance->school_fees) }}</td>
                        <td>Kshs. {{number_format($finance->gown_fees) }}</td>
                        <td><b>Kshs. {{number_format($finance->gown_fees + $finance->school_fees) }}</b></td>
                        <td><button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal{{Auth::User()->email}}" data-whatever="{{Auth::User()->email}}"><i class="fas fa-eye"></i><span class="d-none d-lg-inline"> &nbspView Finance Statement</span></button></td>
                     </tr>
                     <tr>
                        <td colspan="5" class="text-center">
                           @if(($finance->gown_fees + $finance->school_fees)>0)
                           <div class="btn btn-info"><i class="fas fa-info-circle"></i> &nbsp You have to clear all Fees arrears in order to Be Cleared by the Finance Officer</div>
                           @else
                           <div class="btn btn-success"><i class="fas fa-info-circle"></i> &nbsp You have cleared all Fees arrears hence can be cleared for Graduation</div>
                           @endif
                        </td>
                     </tr>
                     @endif
                     @endforeach
                     @else
                     <tr>
                        <td colspan="11">
                           <div class="alert alert-danger">No Record Found</div>
                        </td>
                     </tr>
                     @endif
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal fade" id="exampleModal{{Auth::User()->email}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-credit-card"></i> &nbspFees Statement</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body table-responsive">
                     <table class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th scope="col">Amount Paid</th>
                              <th scope="col">Paid For</th>
                              <th scope="col">Bank Paid From</th>
                              <th scope="col">Transaction Code</th>
                              <th scope="col">Date Paid</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if($feesdata->count()>'0')
                           @foreach($feesdata as $feedata)
                           @if($feedata->email == Auth::User()->email)
                           <tr>
                              <td>Kshs. {{number_format($feedata->amount) }}</td>
                              <td>{{$feedata->reason }}</td>
                              <td>{{$feedata->bank }}</td>
                              <td>{{$feedata->code }}</td>
                              <td>{{$feedata->created_at }}</td>
                           </tr>
                           @endif
                           @endforeach
                           <tr>
                              <th>TOTALS</th>
                              <th>Tuition:<br>Kshs. {{number_format($totalTuits) }}</th>
                              <th>Graduation:<br>Kshs. {{number_format($totalGrads) }}</th>
                              <th>Overall Total<br>Kshs. {{number_format($totalTuits + $totalGrads) }}</th>
                              <th>#</th>
                           </tr>
                           @else
                           <tr>
                              <td colspan="11">
                                 <div class="alert alert-danger">No Record Found</div>
                              </td>
                           </tr>
                           @endif
                        </tbody>
                     </table>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <i class="fas fa-credit-card"></i>&nbsp
               {{ __('Add Fees Payment') }} &nbsp
               <a href="{{url()->previous()}}" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Go Back</a>
            </div>
            <div class="card-body">
               <form method="POST" action="{{ route('saveFees') }}">
                  @csrf
                  <div class="row">
                     <div class="col-md-3 mb-3">
                        <label for="fee_amount" class="col-form-label text-md-end">{{ __('Fees Amount') }}</label>
                        <div class="">
                           <input id="fee_amount" type="number" class="form-control @error('fee_amount') is-invalid @enderror" name="fee_amount" value="{{ old('fee_amount') }}" required autocomplete="fee_amount" autofocus>
                           <input type="hidden" name="email" value="{{ Auth::User()->email }}">
                           @error('fee_amount')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-3 mb-3">
                        <label for="reason" class="col-form-label text-md-end">{{ __('Payment For') }}</label>
                        <div class="">
                           <select id="reason" class="form-control @error('reason') is-invalid @enderror" name="reason" required autofocus>
                              <option>--Select--</option>
                              <option value="tuition">Tuition Fees</option>
                              <option value="graduation">Graduation Fees</option>
                           </select>
                           @error('reason')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-3 mb-3">
                        <label for="bank" class="col-form-label text-md-end">{{ __('Bank Paid To') }}</label>
                        <div class="">
                           <input id="bank" type="text" class="form-control @error('bank') is-invalid @enderror" name="bank" value="{{ old('bank') }}" required autocomplete="bank" autofocus>
                           @error('bank')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-3 mb-3">
                        <label for="code" class=" col-form-label text-md-end">{{ __('Transaction Code') }}</label>
                        <div class="">
                           <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>
                           @error('code')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 mb-0">
                        <div class="">
                           <input type="hidden" name="save" value="create">
                           <button type="submit" class="btn btn-primary btn-sm">
                           <i class="fas fa-save"></i> &nbsp
                           {{ __('Save Fees Data') }}
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection