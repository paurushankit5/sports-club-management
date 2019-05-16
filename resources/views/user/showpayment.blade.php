@extends('layouts.all')

@section('title' , 'Payment')

@section('page_header' , 'Payment')



@section('after_scripts')
    <script type="text/javascript">

        var final_amount = parseInt($("#final_amount").html());
        $(".session_charge").bind('blur keyup',function(){
            getCoachTotal(this);
        });

        $(".discount_coach_session").bind('blur keyup',function(){
            getCoachTotal(this);
        });  

        $(".extra_fees").bind('blur keyup', function(){
            getextrafeestotal(this);
        }); 

        $(".extra_discount").bind('blur keyup', function(){
            getextrafeestotal(this);
        }); 

        function getextrafeestotal(a)
        {
            var extra_fees      = $(a).closest('tr').find('.extra_fees').val();
            var extra_discount  = $(a).closest('tr').find('.extra_discount').val();
            if(extra_fees == '' || extra_fees < 0)
            {
                extra_fees = 0;
            } 
            if(extra_discount == '' || extra_discount < 0)
            {
                extra_discount = 0;
            } 
            var total = extra_fees - extra_discount;
            if(total < 0)
            {
                total = 0;
            }
            final_amount = final_amount - $(a).closest('tr').find('.total_extra_fees').html() + total
            $("#final_amount").html(final_amount);
            $(a).closest('tr').find('.total_extra_fees').html(total);

        }

        function getCoachTotal(a){
            var sport_id = $(a).closest('tr').attr('data-sport_id');
            var session_rate = $(a).closest('tr').attr('data-session_rate');
            var session_count = $("#session_count_"+sport_id).val();
            var discount = $("#discount_coach_session_"+sport_id).val();
            var total = (session_count * session_rate)-discount;
            if(total<0)
            {
                total = 0;
            }
            prev_total = $("#total_session_"+sport_id).html();
            if(prev_total == '' || prev_total =='undefined' || prev_total == 'NaN')
            {
                prev_total = 0;
            }
            final_amount = (final_amount*10 - prev_total*10 + total*10)/10;
            $("#total_session_"+sport_id).html(total);
            $("#final_amount").html(final_amount);

        }

        $(".discount-game").bind('keyup blur',function(){
            var sport_id = $(this).closest('tr').attr('data-sport_id');
            var fees = $(this).closest('tr').attr('data-fees');
            var discount = this.value;
            if(discount == '' || discount < 0 ){
                discount = 0;
            }
            var total = fees - discount;
            if(total < 0){
                total = 0;
            }
            final_amount = (final_amount*10 - $("#membership_total_"+sport_id).html()*10 + total*10)/10;
            console.log(final_amount);
            $("#final_amount").html(final_amount);
            $("#membership_total_"+sport_id).html(total);
        });
        function addRow(tableID) {

            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var colCount = table.rows[0].cells.length;

            for(var i=0; i<colCount; i++) {

                var newcell = row.insertCell(i);

                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }
        }

        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
            }catch(e) {
                alert(e);
            }
        }
    </script>
@endsection
@section('content')
    <div class="row">  
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Extra Charges</h4>
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
                                		<tr>
                                			<td>{{ ++$i }}</td>
                                			@if($payment->extra_fields != Null)
                                				<td>{{ $payment->extra_fields }}</td>
                                			@elseif($payment->coach == Null)
                                				<td>
                                					Membership Fees <br>
                                					<b>{{ $payment->sport->sport_name }}</b>
                                				</td>
                                			@else
                                				<td>
                                					Session Charges <br>
                                					<a href="{{ route('getoneuserprofile', $payment->coach->id) }}">{{ $payment->coach->fname." ".$payment->coach->lname }}</a><br>
                                					<b>{{ $payment->sport->sport_name }} </b>
                                				</td>                                				
                                			@endif
                                			<td>
                            					{{ date('M-Y',strtotime('1/'.$payment->month.'/'.$payment->year)) }}

                            				</td>
                            				<td>
                            					<b>{{ $payment->amount }}</b>
                            					@if($payment->session_count != Null)
                            						<br>
                            						<small>( {{ $payment->session_count }} sessions *  &#x20B9; {{ $payment->per_session_charge }} )</small>
                            					@endif
                            				</td>
                            				<td><b>&#x20B9; <span contenteditable="true">{{ $payment->discount }}</span></b> </td>
                            				<td><b>&#x20B9; {{ $payment->total_amount }}</b></td>
                                		</tr>
                                		@php
                                			$final_amount += $payment->total_amount;
                                		@endphp 
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