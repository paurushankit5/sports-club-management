@extends('layouts.all')

@section('title' , 'Payment')

@section('page_header' , 'Payment')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('clubDashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Payments</li>
@endsection

@section('after_scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$(".showpayments").on('click', function(){
				var year 	= 	$("#year").val();
				var month 	= 	$("#month").val();
				window.location ='/organization/payment/players/'+month+'/'+year ;
			});
		});
	</script>
@endsection

@section('content')
    <div class="row">
      
      
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"> Payment </h4>
            <div class="row">
	            <div class="col-md-4">
	            	<select class="form-control" id="month">
	            		<option value="1">Jan</option>
	            		<option value="2">Feb</option>
	            		<option value="3">Mar</option>
	            		<option value="4">Apr</option>
	            		<option value="5">May</option>
	            		<option value="6">Jun</option>
	            		<option value="7">Jul</option>
	            		<option value="8">Aug</option>
	            		<option value="9">Sep</option>
	            		<option value="10">Oct</option>
	            		<option value="11">Nov</option>
	            		<option value="12">Dec</option>
	            	</select>
	            	<br>
	            </div>
	            <div class="col-md-4">
	            	<select class="form-control" id="year">
	            		@for($i=date('Y'); $i>=2019;$i--)
	            			<option>{{ $i }}</option>
	            		@endfor
	            	</select>
	            	<br>
	            </div>
	            <div class="col-md-4"><button class="btn btn-primary btn-block showpayments">Show Payments</button></div>
        	</div>
            <div class="table-responsive">
            	<table class="table table-striped">
            		<thead>
            			<tr>
            				<th>#</th>
            				<th>Player</th>
            				<th>Invoice</th>
            				<th>Payment Due</th>
            				<th>Last Payment Details</th>
            				<th>Record Payment</th>
            			</tr>
            		</thead>
            		<tbody>
            			@if(count($users))
            				@php $i=1; @endphp
            				@foreach($users as $user)
            					<tr>
            						<td>{{ $i++ }}</td>
            						<td>{{ $user->fname." ".$user->lname }}</td>
            						<td>{!! count($user->payments2) ? 'Generated' : '<a href="/user/payment/'.$user->id.'/'.$month.'/'.$year.'" target="_blank" class="btn btn-rounded btn-sm btn-info">Add Invoice</a>'  !!}</td>
            						<td>&#x20B9; {{ $user->payments->sum('total_amount') - $user->recordpayments->sum('payment_received') }}</td>
            						<td>
            							@if(count($user->recordpayments))
            								&#x20B9; {{ $user->recordpayments[0]->payment_received }} <br>
            								{{ date('d-M-Y',strtotime($user->recordpayments[0]->payment_date)) }}
            							@else
            							 N/A
            							@endif
            						</td>
            					</tr>
            				@endforeach
            			@endif
            		</tbody>
            	</table>
            </div>
          </div>
        </div>
      </div>
      
      
      
    </div>
@endsection