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
                    window.location ='/organization/payment/players/'+month+'/'+year ;
                }
                else{
                    alert('Invalid Request');
                }
			});
            $(".release_invoice").on('click', function(){
                var user_ids =[];  
                $("input:checkbox[name=user_id]:checked").each(function(){
                    user_ids.push($(this).val());
                });
                if(user_ids.length){
                    var r = confirm(" Are you sure you want to release all invoices?");
                    if(r){
                        $.ajax({
                            type    : 'POST',
                            url     :   "{{ route('release_invoice') }}",
                            data    :   {
                                "_token"    :   "{{ csrf_token() }}",
                                "month"     :   "{{ $month }}",
                                "year"     :   "{{ $year }}",
                                "user_ids"  :   user_ids
                            },
                            success     :   function(data){
                                alert(data.msg);
                                location.reload();
                            }
                        })
                    } 
                }
                
            })
            $("#all_checkbox").on('click', function(){
                var check = $("#all_checkbox").is(":checked");
                $(".relaease_invoice_checkbox").attr("checked", check);
            })
        });
            
	</script>
@endsection

@section('content')
    <div class="row">
      
      
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"> Payment 
                @if($release_invoice)
                    <button class="btn btn-success btn-sm float-right release_invoice"> Release Invoice</button>
                @endif
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
	            <div class="col-md-4"><button class="btn btn-primary btn-block showpayments">Show Payments</button></div>
        	</div>
            <div class="table-responsive">
            	<table class="table table-striped">
            		<thead>
            			<tr>
            				<th><input type="checkbox" id="all_checkbox" />&nbsp;&nbsp;&nbsp; #</th>
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

            						<td>  {!! count($user->payments2) && !count($user->release_invoice) ? '<input type="checkbox" name="user_id" value="'.$user->id.'" class="relaease_invoice_checkbox" />&nbsp;&nbsp;&nbsp; ' : '' !!} {{ $i++ }}</td>
            						<td><a href="{{ route('getoneuserprofile', $user->id) }}" target="_blank">{{ $user->fname." ".$user->lname }}</a></td>
            						<td>
                                        @if(count($user->payments2))
                                            <a href="{{route('showpayment', ['user_id' => $user->id,'month'=> $month,'year'=> $year]) }}" target="_blank" class="btn btn-rounded btn-sm btn-success">View Invoice</a>
                                         @else
                                            <a href="/user/payment/{{$user->id}}/{{$month}}/{{$year}}" target="_blank" class="btn btn-rounded btn-sm btn-info">Add Invoice</a>
                                         @endif
                                         @if(count($user->release_invoice))
                                            <br>
                                            <small>
                                                @if($user->release_invoice->is_completed)
                                                    Invoice Released
                                                @else
                                                    Queued For Release.
                                                @endif
                                            </small>
                                         @endif
                                    </td>
            						<td>&#x20B9; {{ $user->payments->sum('total_amount') - $user->recordpayments->sum('payment_received') }}
                                    </td>
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