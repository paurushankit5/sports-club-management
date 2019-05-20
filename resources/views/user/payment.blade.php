@extends('layouts.all')

@section('title' , 'Payment')

@section('page_header' , 'Payment')



@section('after_scripts')
    <script type="text/javascript">
        var final_amount = parseInt($("#final_amount").html());
        var initial_session_charges = $(".session_charges").val();
        $(document).ready(function(){

            $('[data-toggle="popover"]').popover();  
            $(".align-self-center").click();
            
            $(document).on('blur keyup', '.extra_fees', function(){
               getextrafeestotal(this);
            });

            $(document).on('blur keyup', '.extra_discount', function(){
               getextrafeestotal(this);
            });
 
        });

        $(".session_charges").on('blur keyup',function(){
            var session_charges = $(this).val();
            changefinalamount(session_charges,initial_session_charges);
            initial_session_charges = session_charges;
        });

        function changefinalamount(amount_to_be_added = 0,amount_to_be_deducted = 0){
            final_amount = (final_amount*10 + amount_to_be_added*10 - amount_to_be_deducted*10)/10;
            $("#final_amount").html(final_amount);
        }
        
        function getextrafeestotal(a)
        {
            var extra_fees      = $(a).closest('tr').find('.extra_fees').val();
            var extra_discount  = $(a).closest('tr').find('.extra_discount').val();
            if(extra_fees == '' || extra_fees < 0)
            {
                extra_fees = 0;
                $(a).closest('tr').find('.extra_fees').val(0);
            } 
            if(extra_discount == '' || extra_discount < 0)
            {
                extra_discount = 0;
                $(a).closest('tr').find('.extra_discount').val(0);
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

       

        $(".discount-game").bind('keyup blur',function(){
            var sport_id = $(this).closest('tr').attr('data-sport_id');
            var fees = $(this).closest('tr').attr('data-fees');
            var discount = this.value;
            if(discount == '' || discount <= 0 ){
                discount = 0;               
                $(this).closest('th').find('.discount-game-note').addClass('d-none');
            }
            else{
                $(this).closest('th').find('.discount-game-note').removeClass('d-none');
            }
            var total = fees - discount;
            if(total < 0){
                 $(this).val(fees);
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

                
                if(i==4)
                {
                    newcell.innerHTML = '&#x20B9; 0';
                }
                else{
                    newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                }
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
           
        <div class="col-12 grid-margin">
            <form method="post" action="{{ route('storepayment', array($user->id, $month, $year)) }}">
            @csrf 
            <div class="card">
                <div class="card-body">
                    
                	<div class="">
                		@if(count($user->sports))
                            <div class="table-responsive">
                                <table class="table table-striped">
                            @php $final_amount = 0; @endphp
                			@foreach($user->sports as $sport)
                				
                						<tr class="bg-primary">
                							<th colspan="5"><h3 class="text text-center text-white">{{ $sport->sport_name }}</h3></th>
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
                                                <br>
                                                <input type="text" name="membership_note_{{ $sport->id }}" placeholder="Enter Your Remarks" class="form-control discount-game-note d-none">
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
                    <div class="col-12">
                        <h3 class="card-title">Session Charges</h3>
                        <div class="form-group">
                            <label>Session charge</label>
                            <input type="number" value="0" min="0" max="100000" name="session_charges" class="form-control session_charges">
                        </div>
                    </div>
                    <br>
                    <h4 class="card-title">Extra Charges</h4>
                    <div class="table-responsive">
                        <INPUT type="button" class="btn btn-primary btn-sm" value="Add Rows" onclick="addRow('dataTable')" />
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
                                    <td ><input type="number" min="0" max="100000" class="form-control extra_fees" name="extra_fees[]"  value="0" ></td>
                                    <td ><input type="number" min="0" max="100000" class="form-control extra_discount" name="extra_discount[]"  value="0" ></td>
                                    <td>&#x20B9; <span class="total_extra_fees">0</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>               
              </div>
            </div>
            

        
      
      
    </div>
</form>
</div>

     
@endsection