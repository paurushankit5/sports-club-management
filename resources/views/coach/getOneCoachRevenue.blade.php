@extends('layouts.all')

@section('title' , $user->getFullName()."'s Revenue for the month of ".date('M Y',strtotime($year."/".$month."/1")) )

@section('after_scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$(".showpayments").on('click', function(){
				var month 	= 	$("#month").val();
				var year 	= 	$("#year").val();
                if(year != '' && month !='')
                {
                    window.location ='/CoachRevenue/{{$user->id}}/'+month+'/'+year ;
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
            <h4 class="card-title"> {!! $user->getFullNameWithAnchor() !!} Revenue for the month of {{ date('M Y',strtotime($year."/".$month."/1")) }} 
               
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
	            <div class="col-md-4"><button class="btn btn-primary btn-block showpayments">Change Month</button></div>
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
            			@if(count($sessions))
            				@php $i=1; $total =0; @endphp
            				@foreach($sessions as $session)
            					<tr>
            						<td>{{ $i++ }}</td>
            						<td>
            								{!! $session->player->getFullNameWithAnchor() !!}
            						</td>
            						<td>{{ $session->sport->sport_name }}</td>
            						<td>{{ $session->sessio_date }}</td>
            						<td>{{ $session->session_count }}</td>
            						<td> &#x20B9; {{ $session->final_amount }}</td>
            						 
            					</tr>
            					@php $total += $session->final_amount @endphp
            				@endforeach
            				<tr>
            					<td colspan="5"><b class="float-right">Total:</b></td>
            					<td colspan=""><b> &#x20b9; {{ $total }}</b></td>
            				</tr>
            			@endif
            		</tbody>
            	</table>
            </div>
          </div>
        </div>
      </div>
      
      
      
    </div>

@endsection