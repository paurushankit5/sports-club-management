<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com -->
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}"> -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    <style type="text/css">
      
        .container{
            padding:50px;
            min-height : 100%;
        }
      
      tr{
            height: 40px !important;
        }
        table, td, th {  
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 15px;
        }
        th {
             background-color: #4CAF50;
              color: white;
        }
       tr:nth-child(even) {background-color: #f2f2f2;}
  </style>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
        <a href="#" class="pull-right" onclick="window.print()"><i class="fa fa-print fa-2x"></i></a>
        </div>
        <table class="table table-striped table-bordered">
            <tbody id="dataTable">   
                <tr><td colspan="6"><h1 style="text-align: center">{{ env('APP_NAME') }}</h1></td></tr>
                <tr>
                    <th>#</th>
                    <th>Fees</th>
                    <th>Month</th>
                    <th>Amount</th>
                    <th>Discount</th>
                    <th>Total</th>
                </tr>         
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
                                <td><b>  &#x20B9; {{ $payment->amount }}</b> </td>
                                <td>
                                    <b>  &#x20B9; {{ $payment->discount }}</b> 
                                    @if($payment->notes !='')
                                        <br><small>{{ $payment->notes }}</small>
                                    @endif
                                </td>
                                <td><b>  &#x20B9; {{ $payment->total_amount }}</b></td>
                            </tr>
                            @php
                                $final_amount += $payment->total_amount;
                            @endphp 
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="5" ><b style="float: right;">Total:</b></td>
                        <td><p class="text text-primary card-title"><b> &#x20B9;  {{ $final_amount }}</b></p></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
	