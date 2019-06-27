@extends('layouts.all')

@section('title' , 'Payment')

@section('after_scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$(".showpayments").on('click', function(){
				var year 	= 	$("#year").val();
				var month 	= 	$("#month").val();
                if(year != '' && month !='')
                {
                    window.location ='/revenueByCoach/'+month+'/'+year+'/{{ $club->id }}' ;
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
                @if(\Auth::user()->is_superuser)
                <a href="{{ route('clubDetail', $club->id) }}">{{$club->club_name}}'s</a> 
                @endif
               Coach Revenue For {{ date('M-Y',strtotime($month.'/01/'.$year)) }} 
              
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
            				<th>Coach</th>
            				<th>Total Sessions</th>
            				<th>Total Revenue</th>
            			</tr>
            		</thead>
            		<tbody>
            			@if(count($sessions))
            				@php $i=1; @endphp
            				@foreach($sessions as $session)
            					<tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <a href="{{ route('getoneuserprofile', $session->users->id) }}" target="_blank">{{ $session->users->fname." ".$session->users->lname }}</a>
                                    </td>
                                   <td>{{ $session->total_sessions }}</td>
                                   <td><b>&#x20B9; {{ $session->total_amount }}</b></td>
                                     
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
    @includeWhen(\Auth::check() && (\Auth::user()->is_superuser || \Auth::user()->role->id == 1), 'components.recordPaymentComponent')

@endsection