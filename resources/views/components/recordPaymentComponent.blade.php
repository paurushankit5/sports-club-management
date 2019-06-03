<div class="modal fade" id="recordPaymentModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<div class="card">
		              <div class="card-body">
		                <h4 class="card-title">Record Payment for <span id="record_payment_name"></span></h4>
		                <div class="alert alert-fill-primary">Payment Due: &#x20B9; <span id="record_payment_due"></span></div>
		                	<div class="form-group">
 			                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 			                    <label class="form-check-label">
			                        <input type="checkbox" class="form-check-input" id="record_payment_late_fees_2"> Apply Late Fees &#x20B9; <span id="record_payment_late_fees"></span> 
			                    </label>
 		                    </div>
	                 		<div class="row">
		                 		<div class="col-md-6">
			                 		<div class="form-group">
			                 			<label>Payment Amount*</label>
			                 			<input type="number" required  class="form-control" id="record_payment_amount" min="0" max="100000" name="payment_received">
			                 			<input type="hidden" id="record_payment_user_id">
			                 		</div>
			                 	</div>
			                 	<div class="col-md-6">
			                 		<div class="form-group">
			                 			<label>Payment Date*</label>
			                 			<input type="date" value="{{ date('Y-m-d') }}"  class="form-control" name="payment_date" id="payment_date" required >
			                 		</div>
			                 	</div>
		                 	</div>
		                 	
 		                    <br>
		                 	<div class="form-group">
	                 			<label>Remarks</label>
	                 			<input type="text" required  placeholder="Enter Remarks if any" class="form-control" id="record_payment_notes"  name="notes">
	                 		</div>
	                 		<div class="form-group">
	                 			<input type="submit" class="btn btn-primary payment_received_btn">
	                 		</div>
		              </div>
		            </div>
            </div>
		</div>
	</div>
</div>

@section('after_scripts2')
	<script type="text/javascript">
		$(document).ready(function(){
			$("#record_payment_late_fees_2").on('click', function(){
				console.log("hello");
				var late_fees = $("#record_payment_late_fees_2").is(":checked");
				if(late_fees)				{
					var amount_due = window.amount_due + window.late_fees;
				}
				else{
					var amount_due = window.amount_due;
				}
				$("#record_payment_amount").val(amount_due);

			})

            $(".recordpayment").on('click', function(){
                var user_id = $(this).attr("data-user_id");
                $.ajax({
                    type : 'POST',
                    url : "{{ route('getpaymentdetails') }}",
                    data : {
                        '_token' : '{{ csrf_token() }}',
                        'user_id'   : user_id
                    },
                    beforeSend: function(){
                        $("#loadingDiv").show();
                    },
                    success : function(data){
                        $("#loadingDiv").hide();
                        var amount_due 	= 	data.user.invoice_generated - data.user.payment_received;
                        window.amount_due = amount_due;
                        window.late_fees = data.late_fees;
                        $("#record_payment_due").html(amount_due);
                        $("#record_payment_amount").val(amount_due);
                        $("#record_payment_user_id").val(data.user.id);
                        $("#record_payment_late_fees").html(data.late_fees);
                        $("#recordPaymentModal").modal("toggle");
                        //console.log(data);


                    }
                });
            });
            $(".payment_received_btn").on('click', function(){
            	var payment_received = $("#record_payment_amount").val();
            	var payment_date = $("#payment_date").val();
            	var late_fees 	= 	$("#record_payment_late_fees_2").is(":checked");
            	var notes 	= 	$("#record_payment_notes").val();
            	var user_id 	= 	$("#record_payment_user_id").val();
            	if(payment_received == '' || payment_date == '')
            	{
            		alert("Please Enter all details");
            	}
            	else{
            		$.ajax({
            			type: 	"POST",
            			url :   "{{ route('storerecordpayment') }}",
            			data: {
            				"payment_received"	: payment_received,
            				"payment_date"		: payment_date,
            				"notes"				: notes,
            				"user_id"			: user_id,
            				"late_fees"			: late_fees,
            				"_token"			: "{{ csrf_token() }}"
            			},
            			beforeSend : function(){
            				$("#loadingDiv").show();
            			},
            			success	: function(data){
            				$("#loadingDiv").hide();
            				if(data)
            				{
            					$("#recordPaymentModal").modal("toggle");
            					//$("#user_"+user_id).remove();
                                location.reload();
            				}
            			}
            		});
            	}
            });
		});
	</script>
@endsection