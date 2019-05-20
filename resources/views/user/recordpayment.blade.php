@extends('layouts.all')

@section('title' ,"Record Payment for ".$user->fname." ".$user->lname)

@section('page_header' ,"Record Payment for ".$user->fname." ".$user->lname)



@section('after_scripts')

@endsection
@section('content')
    <div class="row">      
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Record Payment for {{ $user->fname." ".$user->lname }}</h4>
                 	<form class="form-horizontal" method="post" action="{{ route('storerecordpayment', $user->id) }}">
                 		@csrf
                 		<div class="form-group">
                 			<label>Amount Received*</label>
                 			<input type="number" required  value="{{ $user->invoice_generated - $user->payment_received ? $user->invoice_generated - $user->payment_received : 0 }}" class="form-control" min="0" max="100000" name="payment_received">
                 		</div>
                 		<div class="form-group">
                 			<label>Payment Date*</label>
                 			<input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="payment_date" required >
                 		</div>
                 		<div class="form-group">
                 			<label>Remarks</label>
                 			<input type="text" required  placeholder="Enter Remarks if any" class="form-control"  name="notes">
                 		</div>
                 		<div class="form-group">
                 			<input type="submit" class="btn btn-primary">
                 		</div>
                 	</form>
              </div>
            </div>

        </div>
         
      
      
      
    </div>

     

    
@endsection