@extends('layouts.all')

@section('title' , 'Revenue By Sports')


@section('after_scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$(".showpayments").on('click', function(){
				var year 	= 	$("#year").val();
				var month 	= 	$("#month").val();
                if(year != '' && month !='')
                {
                    window.location ='/club/revenue/sports/'+month+'/'+year+'/{{ $club->id }}' ;
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
                
                <!-- <a href="{{ route('revenueByCoach', [$month,$year,$club->id]) }}" style="margin-left: 20px;" class="btn btn-primary pull-right btn-sm">Revenue By Coach</a>

                <a href="{{ route('revenueBySport', [$month,$year,$club->id]) }}" class="btn btn-primary pull-right btn-sm">Revenue By Sports</a> -->

            </h4>
            <br>
            <br>    
            <div class="row">
	            <div class="col-md-4">
	            	<select class="form-control" id="month">
	            		<option value="01" @if($month == 1) selected @endif>Jan</option>
	            		<option value="02" @if($month == 2) selected @endif>Feb</option>
	            		<option value="03" @if($month == 3) selected @endif>Mar</option>
	            		<option value="04" @if($month == 4) selected @endif>Apr</option>
	            		<option value="05" @if($month == 5) selected @endif>May</option>
	            		<option value="06" @if($month == 6) selected @endif>Jun</option>
	            		<option value="07" @if($month == 7) selected @endif>Jul</option>
	            		<option value="08" @if($month == 8) selected @endif>Aug</option>
	            		<option value="09" @if($month == 9) selected @endif>Sep</option>
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
            			</tr>
            		</thead>
            		<tbody>
            			@if($club_sport)
            				@php 	$i=0; @endphp
            				@foreach ($club_sport as $sport)
            					<tr>
            						<td> {{ ++$i }} </td>
            						<td> {{ $sport['sport_name'] }} </td>
            						<td> &#X20B9; {{ $sport['revenue'] }} </td>
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