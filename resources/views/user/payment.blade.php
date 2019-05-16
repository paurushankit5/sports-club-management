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
        <form method="post" action="{{ route('storepayment', array($user->id, $month, $year)) }}">
        @csrf    
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Extra Charges</h4>
                    <div class="table-responsive">
                        <INPUT type="button" class="btn btn-primary btn-sm" value="Add More" onclick="addRow('dataTable')" />
                        <INPUT type="button" class="btn btn-danger btn-sm" value="Remove "   onclick="deleteRow('dataTable')" />
                         <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fees</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="dataTable">            
                                <tr>
                                    <td><INPUT type="checkbox"  name="chk[]"/></td>
                                    <td ><input type="text" class="form-control" name="category[]"   ></td>
                                    <td ><input type="number" min="0" class="form-control extra_fees" name="extra_fees[]"  value="0" ></td>
                                    <td ><input type="number" min="0" class="form-control extra_discount" name="extra_discount[]"  value="0" ></td>
                                    <td>&#x20B9; <span class="total_extra_fees">0</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Payment</h4>
                	<div class="row">
                		@if(count($user->sports))
                            <div class="table-responsive">
                                <table class="table table-striped">
                            @php $final_amount = 0; @endphp
                			@foreach($user->sports as $sport)
                				
                						<tr class="bg-primary">
                							<th colspan="5"><h3 class="text text-center text-white">{{ $sport->sport_name }}</h3></th>
                						</tr>
                						<tr data-sport_id="{{ $sport->id }}" data-session_rate="{{ $sport->coach->fee->session_rate }}">
             								@if($sport->coach)    
                                                <td>    
            									   {{$sport->coach->fname." ".$sport->coach->lname}}     
                                                </td>
                                                <td>
                                                    Session Charge:<br>
                                                    &#x20B9; {{$sport->coach->fee->session_rate}}
                                                </td> 
                                                <td>
                                                    Number Of Sessions:<br>
                                                    <input type="number" class="form-control  session_charge"  value="0" min="0" id="session_count_{{ $sport->id }}" name="session_count_{{ $sport->id }}" >
                                                </td> 
                                                <td>
                                                    Discount:<br>
                                                    <input type="number" min="0" class="form-control discount_coach_session" value="0" id="discount_coach_session_{{ $sport->id }}" name="discount_coach_session_{{ $sport->id }}">
                                                </td>
                                                <td>
                                                    Total:<br> &#x20B9;
                                                    <span id="total_session_{{ $sport->id }}">0</span>
                                                </td>                                        
            								@endif
                						</tr>
                						<tr data-fees="{{ $sport->membership->fees[$sport->membership->membership_type] }}" data-sport_id="{{ $sport->id }}">
                							<th>
	                							@if($sport->membership)
	                								{{ $sport->membership->fees->category_name }}
	                							@endif
                							</th>
                                            <th>
                                                Payment Mode:<br>
                                                {{ ucwords($sport->membership->membership_type) }}
                                            </th>
                                            <th>&#x20B9; {{ $sport->membership->fees[$sport->membership->membership_type] }} </th>
                                            <th>
                                                Discount:<br>
                                                <input type="number" min="0" class="form-control discount-game"  value="0" name="membership_discount_{{ $sport->id }}" id="membership_discount_{{ $sport->id }}">
                                            </th>
                                            <th>
                                                @php
                                                    $final_amount += $sport->membership->fees[$sport->membership->membership_type]; 
                                                @endphp
                                                Total: <br>&#x20B9;
                                                <span id="membership_total_{{ $sport->id }}">{{ $sport->membership->fees[$sport->membership->membership_type] }}</span>
                                            </th>
                						</tr>                					
                			         @endforeach
                                     <tr>
                                         <th colspan="4"><span class="pull-right">Total:</span></th>
                                         <td>&#x20B9; <span id="final_amount">{{ $final_amount }}</span></td>
                                     </tr>
                                     <tr>
                                         <th colspan="5">
                                            <input type="submit" class="btn btn-primary pull-right">
                                         </th>
                                     </tr>
                                </table>
                            </div>
                		@endif
                	</div>                
              </div>
            </div>
            

        
      
      
    </div>
</form>
</div>

     
@endsection