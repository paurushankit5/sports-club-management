@extends('layouts.all')

@section('title' , 'My Players')

@section('page_header' , 'My Players')

@section('after_scripts')
    <script type="text/javascript">
    	$(".add_session").on('click', function(){
    		var coach = $(this).closest('tr').find('.coach').val();
    		var date = $(this).closest('tr').find('.date').val();
    		var session_count = $(this).closest('tr').find('.session_count').val();
    		var user_id = $(this).closest('tr').find('.user_id').val();
    		var a = $(this);
    		// console.log(coach);
    		// console.log(date);
    		// console.log(session_count);
    		$.ajax({
    			type: "POST",
    			url : '{{ route("add_session") }}',
    			data : {
    				"sport_id" : '{{ $sport->id }}',
    				"user_id"	: user_id,
    				"coach_id" : coach,
    				"date" : date,
    				"session_count" : session_count,
    				"_token" :  "{{csrf_token()}}",

    			},
    			success : function(data){
    				console.log(data);
    				if(data == '1'){
    					$(".msgbox").html("Session Added successfully").removeClass('d-none');
    					$(a).closest('tr').remove();
    					setTimeout(function(){ $(".msgbox").html("").addClass('d-none'); }, 3000);

    				}
    			}
    		});
    	})
    </script>
@endsection



@section('content')
    <div class="row">
      
      
      	<div class="col-lg-12 grid-margin stretch-card">
	        <div class="card">
	          	<div class="card-body">
	            	<h4 class="card-title">My Players ({{$sport->sport_name}})</h4>
	            	<div class="alert alert-fill-primary msgbox d-none">

	            	</div>
	              	<div class="table-responsive">
	              		<table class="table table-striped">
	              			@if(count($users))
	              				@foreach($users as $user)
	              					<tr>
	              						<th>
	              							<a href="{{ route('getoneuserprofile', $user->id) }}" target="_blank">{{ $user->fname." ".$user->lname }}</a><br>
	              							Balance  &#x20B9; {{ $user->advance_amount }}
	              							<input type="hidden" value="{{ $user->id }}" class="user_id">
	              						</th>
	              						<td>
	              							<label>Select Coach</label>
	              							<select class="form-control coach"  >
	              								@if(count($coaches))
	              									@foreach($coaches as $coach)
	              										<option value="{{ $coach->id }}" @if($coach->id == \Auth::user()->id) selected @endif>{{ $coach->fname." ".$coach->lname }} (&#x20B9; {{$coach->coachfees->session_rate}})</option>
	              									@endforeach
	              								@endif
	              							</select>
	              						</td>
	              						<td>
	              							<label>Date</label>
	              							<input type="date" class="form-control date" value="<?= date('Y-m-d');?>" >
	              						</td>
	              						<td>
	              							<label>Sessions</label>
	              							<select class="form-control session_count">
	              								@for($i=1;$i<=5;$i++)
	              									<option>{{ $i }}</option>
	              								@endfor
	              							</select>
	              						</td>
	              						<td>
	              							<label style="visibility: hidden">Button</label>
	              							<br>
	              							<button class="btn btn-primary add_session"> Add Session </button>
	              						</td>
	              					</tr>

	              				@endforeach
	              			@endif	              			
	              		</table>
	              	</div>	              
	          	</div>
	        </div>
     	</div>
      
      
      
    </div>
@endsection