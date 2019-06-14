@extends('layouts.all')

@section('title' , 'Invoice for '.date('M-Y', strtotime(\Request::segment(4)."/1/".\Request::segment(5))))

@section('page_header' , 'Invoice for '.date('M-Y', strtotime(\Request::segment(4)."/1/".\Request::segment(5))) )



@section('after_scripts')
    <script type="text/javascript">

    	
    </script>
@endsection
@section('content')
    <div class="row">  
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Invoice For {{ date('M-Y', strtotime(\Request::segment(4)."/1/".\Request::segment(5))) }}
                        <a href="{{ route('downloadInvoice',[$user->id, \Request::segment(4), \Request::segment(5)]) }}" target="_blank" class="btn btn-primary btn-sm pull-right">Print Invoice</a>
                    </h4>
                    <p><a href="{{ route('getoneuserprofile', $user->id) }}">{{ $user->fname." ".$user->lname}}</a></p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fees</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="dataTable">            
                                @if(count($payments))
                                	@php
                                		$i=0;
                                		$final_amount =0;
                                	@endphp
                                	@foreach($payments as $payment)
                                        @if($payment->amount !=0)
                                    		<tr>
                                    			<td>{{ ++$i }}</td>
                                    			@if($payment->extra_fields != Null)
                                    				<td>{{ $payment->extra_fields }}</td>
                                    			@elseif($payment->is_session_charge == 0)
                                    				<td>
                                    					Membership Fees <br>
                                                        Payment mode: {{ ucfirst($payment->payment_mode) }}<br>
                                    					<b class="text-primary">{{ $payment->sport->sport_name }}</b>
                                    				</td>
                                    			@else
                                    				<td>
                                    					Session Charges <br>
                                    				</td>                                				
                                    			@endif
                                    			<td> {{ date('M-Y',strtotime($payment->month.'/1/'.$payment->year)) }} </td>
                                				<td><b>&#x20B9; {{ $payment->amount }}</b> </td>
                                                <td>
                                                    <b>&#x20B9; {{ $payment->discount }}</b> 
                                                    @if($payment->notes !='')
                                                        <br><small>{{ $payment->notes }}</small>
                                                    @endif
                                                </td>
                                				<td><b>&#x20B9; {{ $payment->total_amount }}</b></td>
                                    		</tr>
                                    		@php
                                    			$final_amount += $payment->total_amount;
                                    		@endphp 
                                        @endif
                                	@endforeach
                                	<tr>
                                		<td colspan="4"></td>
                                		<td><b>Total:</b></td>
                                		<td><p class="text text-primary card-title"><b>&#x20B9; {{ $final_amount }}</b></p></td>
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