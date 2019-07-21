@extends('layouts.all')

@section('title' , 'Revenue')

@section('after_scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$(".showpayments").on('click', function(){
				var year 	= 	$("#year").val();
				var month 	= 	$("#month").val();
                if(year != '' && month !='')
                {
                    window.location ='/organization/revenue/'+month+'/'+year+'/{{ $club->id }}' ;
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
            <h4 class="card-title"> 
                Revenue For {{ date('M-Y',strtotime($month.'/01/'.$year)) }} 
                
                <a href="{{ route('revenueByCoach', [$month,$year,$club->id]) }}" style="margin-left: 20px;" class="btn btn-primary pull-right btn-sm">Revenue By Coach</a>

                <a href="{{ route('revenueBySport', [$month,$year,$club->id]) }}" class="btn btn-primary pull-right btn-sm">Revenue By Sports</a>

            </h4>
            <br>
            <br>    
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
	            <div class="col-md-4"><button class="btn btn-primary btn-block showpayments">Show Revenue</button></div>
        	</div>
            <div class="table-responsive">
            	<table class="table table-striped">
            		<thead>
            			<tr>
            				<th>#</th>
            				<th>Player</th>
            				<th>Amount</th>
            				<th>Payment Date</th>
            			</tr>
            		</thead>
            		<tbody>
            			@if(count($receivedPayments))
            				@php $i=1; @endphp
            				@foreach($receivedPayments as $payment)
            					<tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <a href="{{ route('getoneuserprofile', $payment->user->id) }}" target="_blank">{{ $payment->user->fname." ".$payment->user->lname }}</a>
                                    </td>
                                    <td><b>&#x20B9; {{ $payment->payment_received }}</b></td>
                                    <td> 
                                        {{ $payment->payment_date }}
                                        @if($payment->notes != '')
                                            <br>
                                            <small>{{ $payment->notes }}</small>
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
    @includeWhen(\Auth::check() && (\Auth::user()->is_superuser ||\Auth::user()->role->id == 1), 'components.recordPaymentComponent')

@endsection