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
                if(year != '' && month !='')
                {
                    window.location ='/organization/payment/players/'+month+'/'+year ;
                }
                else{
                    alert('Invalid Request');
                }
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
	            		<option value="1" @if($month == 1) selected @endif>Jan</option>
	            		<option value="2" @if($month == 2) selected @endif>Feb</option>
	            		<option value="3" @if($month == 3) selected @endif>Mar</option>
	            		<option value="4" @if($month == 4) selected @endif>Apr</option>
	            		<option value="5" @if($month == 5) selected @endif>May</option>
	            		<option value="6" @if($month == 6) selected @endif>Jun</option>
	            		<option value="7" @if($month == 7) selected @endif>Jul</option>
	            		<option value="8" @if($month == 8) selected @endif>Aug</option>
	            		<option value="9" @if($month == 9) selected @endif>Sep</option>
	            		<option value="10" @if($month == 10) selected @endif>Oct</option>
	            		<option value="11" @if($month == 11) selected @endif>Nov</option>
	            		<option value="12" @if($month == 12) selected @endif>Dec</option>
	            	</select>
	            	<br>
	            </div>
	            <div class="col-md-4">
	            	<select class="form-control" id="year">
	            		@for($i=date('Y'); $i>=2019;$i--)
	            			<option  @if($year == $i) selected @endif >{{ $i }}</option>
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
            				<th>Action</th>
            			</tr>
            		</thead>
            		<tbody>
            			@if(count($users))
            				@php $i=1; @endphp
            				@foreach($users as $user)
            					<tr id="user_{{ $user->id }}">
            						<td>{{ $i++ }}</td>
            						<td><a href="{{ route('getoneuserprofile', $user->id) }}" target="_blank">{{ $user->fname." ".$user->lname }}</a></td>
            						<td>{!! count($user->payments2) ? '<a href="'.route('showpayment', ['user_id' => $user->id,'month'=> $month,'year'=> $year]) .'" target="_blank" class="btn btn-rounded btn-sm btn-success">View Invoice</a>' : '<a href="/user/payment/'.$user->id.'/'.$month.'/'.$year.'" target="_blank" class="btn btn-rounded btn-sm btn-info">Add Invoice</a>'  !!}</td>
            						<td>&#x20B9; {{ $user->payments->sum('total_amount') - $user->recordpayments->sum('payment_received') }}</td>
            						<td>
            							@if(count($user->recordpayments))
            								&#x20B9; {{ $user->recordpayments[0]->payment_received }} <br>
            								{{ date('d-M-Y',strtotime($user->recordpayments[0]->payment_date)) }}
            							@else
            							 N/A
            							@endif
            						</td>
                                    <td>
                                        @if($user->payments->sum('total_amount') - $user->recordpayments->sum('payment_received') > 0)
                                            <button class="btn btn-rounded btn-sm btn-info recordpayment" data-user_id="{{ $user->id }}">Record Payment</button>
                                        @else
                                            No Dues
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
    @includeWhen(\Auth::check() && \Auth::user()->role->id == 1, 'components.recordPaymentComponent')

@endsection